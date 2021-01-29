# -*- coding: utf-8 -*-
"""
Created on Tue Jan 26 18:31:14 2021

@author: Benjamin
"""
import pandas as pd
import json

#%% read db.csv
db = pd.read_csv('db.csv')
#save a backup with date flag
db.to_csv('dbold_date.csv',sep=',')

#%% read new_contrib.json

json_name = 'json_array_Vanderborght_Jan_2020-11-01 11_30_11'
with open(json_name + '.txt') as f:
  json2parse = json.load(f)
  
df2add = pd.json_normalize(json2parse)

#%% check for duplicates before adding the new contrib
#try
# id incrementation
df2add['id']=db['id'].max()+1

#%% append
dbnew = db.append(df2add)

#%% save
dbnew.to_csv('db.csv',sep=',')


