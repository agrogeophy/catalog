# -*- coding: utf-8 -*-
"""
Created on Tue Jan 26 18:31:14 2021

@author: Benjamin
"""

import sys

import pandas as pd
import json
import datetime
from datetime import date
import argparse

# import eml_parser
# import email
# from email import policy
# from email.parser import BytesParser

import rich.console
import rich.highlighter
import rich.pretty


DEFAULT_DB = '../db.csv'

parser = argparse.ArgumentParser(description='Process new contribution')
parser.add_argument('-csv', type=str, help='csv')
parser.add_argument('-raw', type=str, help='raw csv')
parser.add_argument('-eml_file', type=str, help='eml new contribution filename')
parser.add_argument('-db', type=str, help='db filename', default=DEFAULT_DB)

args = parser.parse_args()

def make_console(verbose):
    """
    Start up the :class:`rich.console.Console` instance we'll use.

    Parameters
    ----------
    verbose : bool
        Whether or not to print status messages to stderr.
    """
    return rich.console.Console(stderr=True, quiet=not verbose, highlight=False)

def main():

    verbose = True
    console = make_console(verbose)
    style = "bold blue"

    try:
        process(verbose, console, style)
    except Exception:
        style = "bold red"
        console.print()
        console.rule(":fire: Error messages start here :fire:", style=style)
        console.print_exception()
        console.rule(":fire: Error messages above :fire:", style=style)
        console.print()



def process(verbose,console, style,**kargs):

    csv = args.csv 
    db_name = args.db 


    db = pd.read_csv(db_name)
    console.print(db.head())

    #save a backup with date flag
    today = date.today()
    console.print("Today's date:", today, style=style)

    db.to_csv('db_backup' + str(today) +'.csv',sep=',')


    #%% read new contribution
    new = pd.read_csv(csv)
    print(new['id'][0], new['surname'][0], new['name'][0])

    check_values(new,console,style)

    check_duplicate(db,new,console,style)

    add_to_db(db,new,db_name,console,style)


def check_values(new,console,style):

    console.print('checking value types', style=style)

    email_ck = '@'
    lat_long = 'float'
    contribution_type = 'Peer reviewed publication'
    publication_date_ck = datetime.date


    new_dict = new.to_dict()

    if isinstance(new_dict['publication_date'][0], publication_date_ck):
        console.print('publication_date not correct', style='bold red')
        sys.exit()

    if '@' not in new_dict['email'][0]:
        console.print('email not correct', new_dict['email'][0], style='bold red')
        sys.exit()



def check_duplicate(db,new,console,style):

    console.print('checking duplicates', style=style)

    unique_keys_check = ['publication_link','latitude']

    db_dict = db.to_dict()
    new_dict = new.to_dict()

    pub_link = db['publication_link'].tolist()

    if new_dict['publication_link'][0] in pub_link:
        console.print('simililar DOI', style='bold red')
        sys.exit()


def add_to_db(db,new,db_name,console,style):

    new['id']=db['id'].max()+1
    db = db.append(new)
    print(db[-3:])

    db.to_csv(db_name,sep=',',index=False)

    today = date.today()

    name_backup = new['publication_link'][0] + new['surname'][0] + new['name'][0] + today
    new.to_csv('../backup/'+ str(name_backup),sep=',',index=False)


def eml_parser():
    '''
    Parse directly from eml file

    '''

    eml_file_new_contrib = args.eml_file 


    with open(eml_file_new_contrib, 'rb') as fp:  # select a specific email file from the list
        name = fp.name # Get file name
        msg = BytesParser(policy=policy.default).parse(fp)

    text = msg.get_content()
    fp.close()

    print(text)





if __name__ == '__main__':
    main()

