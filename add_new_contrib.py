# -*- coding: utf-8 -*-
"""
Created on Tue Jan 26 18:31:14 2021

@author: Benjamin
"""
import pandas as pd
import json
# import eml_parser
# pip install eml_parser
import datetime

# def json_serial(obj):
#   if isinstance(obj, datetime.datetime):
#       serial = obj.isoformat()
#       return serial

path_backup= 'C:/Users/Benjamin/Documents/Z_Database/bib2add/'
# with open(path_backup + 'CAGS contribution.eml', 'rb') as fhdl:
#   raw_email = fhdl.read()

# ep = eml_parser.EmlParser()
# parsed_eml = ep.decode_email_bytes(raw_email)

# print(json.dumps(parsed_eml, default=json_serial))

db = pd.read_csv('db.csv')
db['name'] == 'weigand'

#%% read db.csv
db = pd.read_csv('db.csv')
#save a backup with date flag
db.to_csv('db_backup.csv',sep=',')

#%% read new_contrib.json

# json_name = 'json_array_Vanderborght_Jan_2020-11-01 11_30_11'
# with open(json_name + '.txt') as f:
#   json2parse = json.load(f)
json_name = path_backup + 'Martin_042821'
with open(json_name + '.json') as f:
  json2parse = json.load(f)
  

df2add = pd.json_normalize(json2parse)
df2add['id']=db['id'].max()+1
# df2add.iloc[0]=db.iloc[-1,0].max()+1


#%% check for duplicates before adding the new contrib
#try
# id incrementation
dbnew = []
dbnew = db.append(df2add)
# duplicateRowsDF = dbnew[dbnew.duplicated()]
duplicateRowsDF = dbnew[dbnew.duplicated(['publication_link'])] #, 'City'])]

duplicateRowsDF['publication_link']

duplicateRowsDF = duplicateRowsDF['publication_link'].dropna()
if len(duplicateRowsDF.index) == 0:
    #%% save
    dbnew.to_csv('db.csv',sep=',')
else:
    print('Already existing')



