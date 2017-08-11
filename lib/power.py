#coding: utf-8

import traceback
import logging

import Common
import retcode
import esunmysql

########################
MYSQL_USER_CONFIG = 'enskill_misc'

##
# 根据域用户查询用户名
# @author liub
# @return dict 列表
# CODE 返回码 >0成功  <0失败
# MSG 返回信息
# info 字典 为空
# list 字典列表
#
def getPwadminUser(authname):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql =  """ select ap_id as id,
                           ap_parentid as parentid,
                           ap_username as username,
                           ap_userpwd as userpwd,
                           ap_truename as truename,
                           ap_date  as createdate,
                           ap_lastdate as lastdate,
                           ap_ispass as ispass,
                           ap_lastip as lastip,
                           ap_xmlpath as xmlpath,
                           ap_tmppwd as tmppwd,
                           to_days(now())-to_days(ap_pwdtime) as day,
                           ap_oldpwd,
                           ap_opadmin,
                           ap_department as department,
                           ap_admintype as admintype,
                           ap_500user as authuser,
                           ap_mobile as mobile 
                      from pw_admin where ap_500user = %(authname)s """
        args = dict()
        args['authname'] = authname
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 查询站点列表
# @author peter
# @param  id    编号
# @table   b_playnote
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getPermissionBySite(siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)

    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select * from pw_permission where ap_siteid = %(siteid)s'''
        args = {'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 创建主目录树xml
# @author peter
# @param  id    编号
# @table   b_playnote
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def buildMainMenuTreeXml(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if ids=='' or ids==None:
            sql ='''select at_id as id,at_name as showname,ifnull(at_path, '') as url,at_name as "RENAME", at_divno as "LEVEL",
                at_parentid as fatherid,'' as tip,at_displayorderno as "ORDER"  from 
                pw_treenav where at_isshow = 1  order by fatherid, "ORDER" desc, url, id '''
        else:
            sql ='''select at_id as id,at_name as showname,ifnull(at_path, '') as url,at_name as "RENAME", at_divno as "LEVEL",
                at_parentid as fatherid,'' as tip,at_displayorderno as "ORDER"  from 
                pw_treenav where at_isshow = 1  and at_id in ('''+ids+''') order by fatherid, "ORDER" desc, url, id '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 创建主目录树xml
# @author peter
# @param  id    编号
# @table   pw_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getMenuTreeXml2(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select at_id as id,at_name as showname,ifnull(at_path, '') as url,at_name as "RENAME",
                       at_divno as "LEVEL",at_parentid as fatherid,'' as tip,at_displayorderno as "ORDER"
                       from pw_treenav where at_isshow = 1 and at_id in ('''+ids+''') '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 查询安全登录日志
# @author peter
# @param  id    编号
# @table   pw_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getSecurityLog(plattype, logtype, username, starttime, endtime, curpage, pagesize):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sqlcount  = '''select count(*) cnt from pw_securitylog where 1= 1'''
        sql       = '''select f_id,f_username,f_title,f_type,f_time,f_note,f_platform,f_ip from pw_securitylog where 1= 1 '''
        where     = ''' 
                    and (f_platform= %(plattype)s or %(plattype)s = '') 
                    and (f_type= %(logtype)s or %(logtype)s = '') 
                    and (f_username= %(username)s or %(username)s = '') 
                    and (f_time between to_days(%(starttime)s) and to_days(%(endtime)s))
                    '''
        limit     = ''' limit %(offset)s, %(limit)s '''

        sqlcount  = sqlcount + where
        sql       = sql + where + limit
        argscount = { 'plattype':plattype,'logtype':logtype,'username':username,
                      'starttime':starttime,'endtime':endtime,
                    }
        args = { 'plattype':plattype,'logtype':logtype,'username':username,
                 'starttime':starttime,'endtime':endtime,
                 'offset': int(curpage) * int(pagesize) - int(pagesize),
                 'limit' : int(pagesize)
               }

        ret = db.query(sqlcount, argscount)
        cnt = ret[0]['cnt']
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql, args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 获取目录树xml
# @author peter
# @param  id    编号
# @table   pw_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getMenuTreeXml(ids,siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        if ids=='':
            sql ='''select at_id as id,at_name as showname,ifnull(at_path, '') as url,at_name as "RENAME",
                       at_divno as "LEVEL",at_parentid as fatherid,'' as tip,at_displayorderno as "ORDER" 
                       from pw_treenav where at_isshow = 1 and FIND_IN_SET(at_id, getChildList(%(siteid)s))'''
            args = {'siteid':siteid}
        else:
            sql ='''select at_id as id,at_name as showname,ifnull(at_path, '') as url,at_name as "RENAME",
                       at_divno as "LEVEL",at_parentid as fatherid,'' as tip,at_displayorderno as "ORDER" 
                       from pw_treenav where  at_id in ('''+ids+''')'''
            args = {}

        ret = db.query(sql, args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# oracle递归查询获取目录树
# @author peter
# @param  id    编号
# @table   b_playnote
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getTreeByNode(nid,type):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        if type =='0':
            sql ='''Select at_id as id,at_parentid as parentid,at_name as "NAME",ifnull(at_path, '') as url,at_isshow as isshow,at_divno as "LEVEL",
                       at_displayorderno as "ORDER" From pw_treenav where FIND_IN_SET(at_id, getChildList(%(nid)s)) Order By at_id'''
        elif type=='1':
            sql = '''Select at_id as id,at_parentid as parentid,at_name as "NAME",ifnull(at_path, '') as url,at_isshow as isshow,
                            at_divno as "LEVEL",at_displayorderno as "ORDER" From pw_treenav where FIND_IN_SET(at_id, getParentList(%(nid)s)) Order By at_id'''
        args = {'nid':nid}

        ret = db.query(sql, args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 根据用户名和登录的域名获取用户xml
# @author peter
# @table  pw_userxml
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getUserXmlByHost(username,hostname):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql ='''select ax_id,ax_username,ax_hostname ,ax_xmlpath  from pw_userxml where ax_username= %(username)s and ax_hostname= %(hostname)s '''
        args = {'username':username,'hostname':hostname}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取部门站点列表
# @author peter
# @table  pw_site,pw_pokerdept_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getSiteByDept(dpid,siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql ='''select a.aw_id aw_id, a.aw_sitename aw_sitename, a.aw_staticpath aw_staticpath, a.aw_siteurl aw_siteurl, b.sd_xmlurl from pw_site a 
                    inner join pw_pokerdept_site b on a.aw_id = b.sd_siteid 
                where   (b.sd_dpid   = %(dpid)s or %(dpid)s = '')
                    and (b.sd_siteid = %(siteid)s or %(siteid)s = '')
              '''
        args = {'dpid':dpid,'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 根据用户ID获取关联站点
# @author peter
# @table  pw_permission_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getHostInfoByUser(userid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql ='''select pn_siteid as siteid from pw_permission_treenav where pn_userid = %(userid)s group by pn_siteid'''
        args = {'userid':userid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取站点
# @author peter
# @table  pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getSiteList(sid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select aw_id, aw_sitename, aw_staticpath, aw_siteurl from pw_site  where (aw_id =%(sid)s or %(sid)s = '' ) order by aw_id asc '''
        args = {'sid':sid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 查找单条管理员在线信息
# @author peter
# @table  pw_online
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getOnlineInfoByIdAndPwd(userid,pwd):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        args = {'userid':userid,'pwd':pwd}
        sql ='''select ao_userId as Id,ao_ip as Ip,ao_date as "DATE",ao_pwd as Pwd from pw_online where ao_userid=%(userid)s and ao_pwd=%(pwd)s limit 1 '''
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 获取站点静态xml地址
# @author peter
# @table  pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getStaticPathByhost(siteurl,username):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ax_id, ax_username, ax_hostname, ax_xmlpath from pw_userxml where ax_hostname=%(siteurl)s and ax_username=%(username)s'''
        args = {'siteurl':siteurl,'username':username}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取站点静态xml地址
# @author peter
# @table  pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getStaticPathByhost2(siteurl):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select aw_id, aw_sitename, aw_staticpath, aw_siteurl from pw_site where aw_siteurl=%(siteurl)s '''
        args = {'siteurl':siteurl}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取站点ID
# @author peter
# @table  pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAwid(siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql =''' select aw_id from pw_site where aw_id=%(siteid)s'''
        args = {'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取权限类型
# @author peter
# @table pw_category
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getCategoryList(id):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ac_id , ac_name , ac_remark, ac_siteid  from pw_category  
                where ac_id = %(id)s or %(id)s = ''
             '''
        args = {'id':id}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取权限类型by siteid
# @author peter
# @table pw_category
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getCategoryListBysiteId(siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ac_id , ac_name , ac_remark,ac_siteid  from pw_category 
                where ac_siteid = %(siteid)s or %(siteid)s = ''
             '''
        args = {'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过站点获取该站点下的所有组
# @author peter
# @table pw_permissiongroup
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getByGroupSiteId(siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select * from pw_permissiongroup where ag_siteid = %(siteid)s'''
        args = {'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过站点获取该站点下的所有组
# @author peter
# @table pw_permissiongroup
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getpermissionListBysiteId(siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id    as id,ap_name  as name,ap_about as about,
                 ap_date  as createdate,ap_siteid as siteid,ap_cateid as cateid,
                 aw_sitename as sitename from pw_permission a
                  inner join pw_site b on a.ap_siteid = b.aw_id
                  where a.ap_siteid = %(siteid)s'''
        args = {'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 根据权限ID获取相关联的的节点列表
# @author peter
# @table pw_permission
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getPermissionByPid(permissionid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_name  as name,ap_about      as about,
                       ap_date       as createdate,ap_siteid     as siteid,
                       ap_cateid     as cateid,ap_treenavid  as treenavid 
                       from pw_permission where ap_id in ('''+permissionid+''') order by ap_id asc'''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 根据用户ID和站点ID获取关联站点获取节点信息
# @author peter
# @table pw_permission_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getTreeNodes(userid,siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select pn_userid  as userid,pn_treenavid    as treenavid,pn_siteid       as siteid,pn_permissionid as id 
            from pw_permission_treenav where pn_userid = %(userid)s and pn_siteid = %(siteid)s '''
        args = {'userid':userid,'siteid':siteid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 查找单条管理员记录
# @author peter
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminInfo(id,username,parent):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        where  = ''
        args={}
        sql    = '''select ap_id as id,ap_parentid as parentid,ap_username as username,ap_userpwd as userpwd,ap_truename as truename,
                        ap_date as createdate,ap_lastdate as lastdate,ap_ispass as ispass,ap_lastip as lastip,ap_xmlpath as xmlpath,
                        ap_tmppwd as tmppwd,to_days(now())-to_days(ap_pwdtime) as day,ap_oldpwd,ap_opadmin from pw_admin where 1=1  '''
        
        if  len(id)>0:
            where  = ' and  ap_id = %(id)s '
            args['id'] = id
        elif len(username)>0:
            where = ' and ap_username= %(username)s '
            args['username'] = username   
        elif len(parent)>0:
            where =' and ap_parentid = %(parentid)s ' 
            args['parentid'] = parent
        
        sql = sql + where
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查找单条管理员
# @author peter
# @table pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminInfo2(apid,username,parentid,usergroup,truename,apuser,userpwd):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_parentid as parentid,
                       ap_username as username,ap_userpwd as userpwd,
                       ap_truename as truename,ap_date as createdate,
                       ap_lastdate as lastdate,ap_ispass as ispass,
                       ap_lastip as lastip,ap_xmlpath as xmlpath,
                       ap_tmppwd as tmppwd,to_days(now())-to_days(ap_pwdtime) as day,
                       ap_oldpwd,ap_opadmin,ap_department as department,
                       ap_admintype as admintype,ap_500user as ap500user,ap_mobile as mobile
               from pw_admin 
               where    (ap_id = %(apid)s or %(apid)s = '')
                    and (ap_username= %(username)s or %(username)s = '')
                    and (ap_parentid= %(parentid)s or %(parentid)s = '') 
                    and (ap_usergroup=%(usergroup)s or %(usergroup)s = '')
                    and (ap_truename= %(truename)s or %(truename)s = '')
                    and (ap_500user= %(apuser)s or %(apuser)s = '')
                    and (ap_userpwd= %(userpwd)s or %(userpwd)s = '')
               '''
        args = {'apid':apid,'username':username,'parentid':parentid,'usergroup':usergroup,'truename':truename,'apuser':apuser,'userpwd':userpwd}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 查找多条管理员
# @author peter
# @table pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminInfos(apid,username,parentid,usergroup,department,admintype,ispass):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_parentid as parentid,
                       ap_username as username,ap_userpwd as userpwd,
                       ap_truename as truename,ap_date as createdate,
                       ap_lastdate as lastdate,ap_ispass as ispass,
                       ap_lastip as lastip,ap_xmlpath as xmlpath,
                       ap_tmppwd as tmppwd,to_days(now())-to_days(ap_pwdtime) as day,
                       ap_oldpwd,ap_opadmin,ap_department as department,ap_admintype as admintype
               from pw_admin 
               where    ( ap_id = %(apid)s or %(apid)s = '')  
                    and ( ap_username= %(username)s or %(username)s = '')
                    and ( ap_parentid= %(parentid)s or %(parentid)s = '')
                    and (ap_usergroup= %(usergroup)s or %(usergroup)s = '')
                    and (ap_department=%(department)s or %(department)s = '')
                    and (ap_admintype=%(admintype)s or %(admintype)s = '')
                    and (ap_ispass=%(ispass)s or %(ispass)s = '')
              ORDER BY ap_ispass DESC, ap_truename '''
        args = {'apid':apid,'username':username,'parentid':parentid,'usergroup':usergroup,'department':department,'admintype':admintype,'ispass':ispass}
        ret = db.query(sql,args)

        for d in ret:
            logging.info('%s' %d)
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查询管理员有权限的站点及其对应的XML文件路径
# @author peter
# @table pw_userxml
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminHostInfo(username):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ax_id as id,ax_hostname as hostname,ax_xmlpath as xmlpath,ax_siteid siteid from pw_userxml where ax_username=%(username)s'''
        args = {'username':username}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查询部门列表
# @author peter
# @table pw_permissiongroup,pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getGroupInfo(gid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ag_id as id,ag_parentid  as parentid,
                       ag_name      as name,ag_about     as about,
                       ag_date      as createdate,ag_siteid    as siteid,
                       aw_sitename  as sitename from pw_permissiongroup a 
                 inner join pw_site b on a.ag_siteid = b.aw_id where ag_id = %(gid)s '''
        args = {'gid':gid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查找单条权限信息
# @author peter
# @table pw_permission,pw_site
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getPermissionInfo(pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id  as id,ap_name      as name,
                       ap_about     as about,ap_date      as createdate,
                       ap_siteid    as siteid,ap_cateid    as cateid,
                       ap_treenavid  as treenavid,aw_sitename  as sitename
                from pw_permission a inner join pw_site  b on a.ap_siteid = b.aw_id
                where ap_id = %(pid)s '''
        args = {'pid':pid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取下属组
# @author peter
# @table  pw_Permissiongroup,pw_usergroupitem
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getSubGroupById(id):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select a.* from pw_permissiongroup a join pw_usergroupitem b on a.ag_id =  b.au_groupid 
                 where b.au_userid = %(id)s '''
        args = {'id':id}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取组权限列表
# @author peter
# @table  pw_Permissiongroup,pw_usergroupitem
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getPermissionByGroupId(gid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select  ag_id AS ID, ag_groupid AS groupid, ag_permissionid AS permissionid,ap_level 
                        FROM pw_groupitem INNER JOIN pw_permission ON ag_permissionid = ap_id where ag_groupid in ('''+gid+''') '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过权限ID查找具有该权限的权限组
# @author peter
# @table  pw_Permissiongroup,pw_usergroupitem
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getGroupByPid(pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select a.ag_name as name from pw_permissiongroup a join pw_groupitem b on a.ag_id = b.ag_groupid and b.ag_permissionid = %(pid)s'''
        args = {'pid':pid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取用户权限组列表
# @author peter
# @table  pw_Permissiongroup,pw_usergroupitem
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getUserGroupItemById(augid,auuid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select au_id as id, au_groupid as groupid, au_userid as userid from pw_usergroupitem 
                  where   (au_groupid = %(augid)s or %(augid)s = '') 
                      and (au_userid= %(auuid)s or %(auuid)s = '')
             '''
        args = {'augid':augid,'auuid':auuid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过权限ID查找具有该权限的权限用户
# @author peter
# @table  pw_permission,pw_groupitem,pw_permissiongroup,pw_userGroupItem,pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getUserInfoByPid(pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select e.ap_id        as id,e.ap_parentid  as parentid,e.ap_username  as username,
                       e.ap_truename  as truename,e.ap_date      as createdate,
                       e.ap_lastdate  as lastdate,e.ap_ispass    as ispass,e.ap_lastip    as lastip
                       from pw_permission a join pw_groupitem b on a.ap_id = b.ag_permissionid
                join pw_permissiongroup c on b.ag_groupid = c.ag_id 
                join pw_usergroupitem d on c.ag_id = d.au_groupid 
                join pw_admin e on e.ap_id = d.au_userid where a.ap_id = %(pid)s '''
        args = {'pid':pid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过一组parentIdList 获取对应组列表
# @author peter
# @table  pw_permissiongroup
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getGroupListByParentGids(gids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ag_id as id,ag_parentid  as parentid,ag_name      as name,
                       ag_about     as about,ag_date      as createdate from pw_permissiongroup 
                where ag_parentid in ('''+gids+''') '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 根据树节点获取权限列表、获取站点下已关联节点的权限
# @author peter
# @table  pw_permission
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getPermissionByNavid(siteid,treenavid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id     as id,ap_name       as name,ap_about      as about,
                       ap_date       as createdate,ap_siteid     as siteid,
                       ap_cateid     as cateid,ap_treenavid  as treenavid
                from pw_permission 
                where   (ap_siteid = %(siteid)s or %(siteid)s = '')
                    and (ap_treenavid = %(treenavid)s or %(treenavid)s = '')
            '''
        args = {'siteid':siteid,'treenavid':treenavid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 根据树节点获取权限列表、获取站点下已关联节点的权限
# @author peter
# @table  pw_permission
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getTreeNavInfo(atid,atname,parentid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select at_id  as id,at_parentid as parentid,
                       at_name as name,at_displayOrderNo as displayOrderNo,
                       at_path     as path,at_isshow as isshow,
                       at_rootId   as rootId,at_divNo as divNo,
                       at_orderNo as OrderNo,at_date as createDate,
                       at_classpath as classPath from pw_treenav where 
                       (at_id=%(atid)s or %(atid)s = '') 
                       and (at_name= %(atname)s or %(atname)s = '')
                       and (at_parentid= %(parentid)s or %(parentid)s = '')
             '''
        args = {'atid':atid,'atname':atname,'parentid':parentid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过权限ID查找具有该权限的权限用户
# @author peter
# @table  pw_permission_treenav,pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getUserListByPid(pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select b.ap_id as id,b.ap_parentid  as parentid,b.ap_username  as username,
                       b.ap_truename  as truename,b.ap_date      as createdate,b.ap_lastdate  as lastdate,
                       b.ap_ispass    as ispass,b.ap_lastip    as lastip from 
                       pw_permission_treenav a left join pw_admin b on b.ap_id = a.pn_userid
                       where a.pn_permissionid = %(pid)s'''
        args = {'pid':pid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取导航
# @author peter
# @table  pw_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getTreeNavigation(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select at_id as id,at_name as name from pw_treenav where at_id in ('''+ids+''') order by at_divno asc'''
        logging.info('%s' %sql)
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过用户ID列表获取用户信息
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminListByIds(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_parentid as parentid,ap_username as username,
                       ap_userpwd as userpwd,ap_truename as truename,ap_date as createdate,
                       ap_lastdate as lastdate,ap_ispass as ispass,ap_lastip as lastip,
                       ap_xmlpath as xmlpath from pw_admin where ap_id in ('''+ids+''') '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过组ID获取用户列表
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminListByGId(gid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_parentid as parentid,ap_username as username,ap_userpwd as userpwd,
                       ap_truename as truename,ap_date as createdate,ap_lastdate as lastdate,ap_ispass as ispass,
                       ap_lastip as lastip,ap_xmlpath as xmlpath from pw_admin a join pw_usergroupitem b on b.au_userid = a.ap_id
                       where b.au_groupId = %(gid)s '''
        args = {'gid':gid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过组ID获取用户列表
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getAdminXmlByPath(xmlpath):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id,ap_userName as username from pw_admin where ap_xmlpath= %(xmlpath)s '''
        args = {'xmlpath':xmlpath}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 查找单条管理员在线信息
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getOnlineInfoByIdAndPwd(userid,pwd):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ao_userId as Id,ao_ip as Ip,ao_date as "DATE",ao_pwd as Pwd from pw_online 
                           where ao_userid= %(userid)s and ao_pwd= %(pwd)s limit 1 '''
        args = {'userid':userid,'pwd':pwd}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查找单条管理员在线信息
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getOnlineList(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if len(ids)>0:
            sql ='''select b.ap_username as userName,b.ap_truename as truename,a.ao_userId as Id,a.ao_ip as Ip,a.ao_date as "DATE",ao_pwd as pwd 
                   from pw_online a join pw_admin b on a.ao_userid=b.ap_id  where a.ao_userid in ('''+ids+''') order by a.ao_userid,a.ao_date '''
            args = {}
        else:
            sql ='''select b.ap_username as userName,b.ap_truename as truename,a.ao_userId as Id,a.ao_ip as Ip,a.ao_date as "DATE",ao_pwd as pwd
                      from pw_online a join pw_admin b on a.ao_userid=b.ap_id order by a.ao_userid,a.ao_date '''
            args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查询用户不重复的用户配置文件
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getUserXmlPath():
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select  ap_id as id,ap_xmlpath as xmlpath from pw_admin a where a.ap_ID in (select max(ap_ID) from pw_admin where 1=1 GROUP BY ap_xmlpath)   order by ap_ID desc '''
        args = {}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
#  修改管理员帐号信息
# @author peter
# @table  pw_treenav
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def modifyTreeNavInfo2(name,parentid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select at_id as id from pw_treenav where at_name =  %(name)s and at_parentid = %(parentid)s '''
        args = {'name':name,'parentid':parentid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 修改管理员帐号信息
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def modifyAdminInfo2(username):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ap_id as id from pw_admin where ap_username =  %(username)s'''
        args = {'username':username}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 修改管理管理组信息
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def modifyGroupInfo2(name,parentid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select ag_id as id from pw_permissiongroup where ag_name = %(name)s and ag_parentid = %(parentid)s '''
        args = {'name':name,'parentid':parentid}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 通过权限ID查找具有该权限的权限用户
# @author peter
# @table  pw_permission_treenav,pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delHostInfoByUser(userid,siteid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_permission_treenav where pn_userid = %(userid)s and pn_siteid = %(siteid)s'''
        args = {'userid':userid,'siteid':siteid}
        ret=db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp
##
# 用户类别管理
# @author peter
# @table  pw_userxml
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyUserGroup(type,id=None,name=None,author=None,depart=None,offset=None,limit=None):
def modifyUserGroup(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    type = kwargs.get('type')
    try:
        args = {}
        if type=='0':
            args = {'id'    :kwargs.get('id'),        'name':kwargs.get('name'),
                    'author':kwargs.get('author'), 'depart':kwargs.get('depart')}
            sqlcount = '''select count(*) cnt  from pw_user_group a inner join pw_pokerdept b on a.g_depart = b.d_id where (g_id= %(id)s or %(id)s = '')
                                and (g_group= %(name)s or %(name)s = '') and (g_author= %(author)s or %(author)s = '')
                                and (g_depart= %(depart)s or %(depart)s = '') '''

            retcnt = db.query(sqlcount, args)
            cnt = retcnt[0]['cnt']

            sql    = '''select * from pw_user_group a inner join pw_pokerdept b on a.g_depart = b.d_id where (g_id= %(id)s or %(id)s = '') 
                     and (g_group= %(name)s or %(name)s = '') and (g_author= %(author)s or %(author)s = '') 
                     and (g_depart= %(depart)s or %(depart)s = '') order by g_depart'''
            ret = db.query(sql, args)

            resp['info']['cnt'] = str(cnt)

            for d in ret:
                resp['list'].append(Common.mapMembers2str(d))
            return resp
        elif type=='1':
            sql  = '''insert into pw_user_group(g_group, g_author, g_depart) values( %(name)s, %(author)s, %(depart)s)'''
            args = { 'name'  : kwargs.get('name'),
                     'author': kwargs.get('author'),
                     'depart': kwargs.get('depart')
                   }
        elif type =='2':
            #将前端传过来的''转化为None，便于ifnull判断
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None

            sql = '''update pw_user_group 
                     set g_group = ifnull(%(name)s,g_group),
                         g_author= ifnull(%(author)s,g_author),
                         g_depart= ifnull(%(depart)s,g_depart)
                     where g_id = %(id)s '''
            args = { 'id'    : kwargs.get('id'),
                     'name'  : kwargs.get('name'),
                     'author': kwargs.get('author'),
                     'depart': kwargs.get('depart')
                   }
        elif type =='3':
            args = {'id': kwargs.get('id')}
            sql = '''delete from pw_user_group where g_id = %(id)s '''

        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 更新交易参数配置信息
# @author peter
# @param  lotid 彩种
# @param  playtype 玩法
# @table  web_addtradeparam
# @sqltype select
# @return dict 列表
#         info 字典 为空
#         list 字典列表

def addUserStaticXml(username,hostname,xmlpath):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql = '''select count(*) cnt
                 from   pw_userxml
                 where  ax_username = %(username)s and ax_hostname=%(hostname)s '''
        args = {'username':username, 'hostname':hostname}
        ret = db.query(sql, args)
        cnt = ret[0].get('cnt')

        sql = ''' select aw_id
                  from   pw_site
                  where  aw_siteurl = %(hostname)s '''
        args = {'hostname':hostname}
        ret = db.query(sql, args)
        siteid = ret[0].get('aw_id')

        if cnt > 0:
            sql  = '''select ax_id from pw_userxml where ax_username = %(username)s and ax_hostname = %(hostname)s '''
            args = {'username':username, 'hostname':hostname}
            ret  = db.query(sql, args)
            axid = ret[0].get('ax_id')
            
            sql  = '''update pw_userxml 
                      set ax_xmlpath = %(xmlpath)s,
                          ax_siteid  = %(siteid)s
                      where ax_id   = %(axid)s '''
            args = {'xmlpath':xmlpath, 'siteid':siteid, 'axid':axid}
            ret  = db.execute(sql, args)

            if not ret:
                db.commit()
                resp['MSG'] = '该xml已存在,更新成功'
                return resp

        sql = '''insert into 
                 pw_userxml(ax_username,ax_hostname ,ax_xmlpath,ax_siteid)
                     values(%(username)s, %(hostname)s, %(xmlpath)s, %(siteid)s )'''
        args = {'xmlpath':xmlpath, 'siteid':siteid, 'username':'username', 'hostname':hostname}
        ret  = db.execute(sql, args)
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp



# 删除管理员有权限的站点及其对应的XML文件路径
# @author peter
# @table  pw_userxml
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delAdminHostInfo(id):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_userxml where ax_id= %(id)s'''
        args = {'id':id}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除管理员
# @author peter
# @table  pw_admin
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delAdmins(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_admin where ap_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除管理组
# @author peter
# @table  pw_permissiongroup
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delGroups(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_permissiongroup where ag_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除权限
# @author peter
# @table  pw_permission
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delPermission(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_permission where ap_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 批量更改管理员状态
# @author peter
# @table  pw_admin
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def setAdminState(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''update pw_admin set ap_ispass = 1 - ap_ispass where ap_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 插入单条权限组
# @author peter
# @table  pw_groupitem
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def insertGroupitem(gid,pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''insert into pw_groupitem(ag_groupid, ag_permissionid) values(%(gid)s, %(pid)s) '''
        args = {'gid':gid,'pid':pid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 删除权限组
# @author peter
# @table  pw_groupitem
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delGroupitem(gid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_groupitem where ag_groupid = %(gid)s '''
        args = {'gid':gid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 插入单条用户组
# @author peter
# @table pw_usergroupitem
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def insertUserGroupitem(uid,gid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''insert into pw_usergroupitem(au_groupid, au_userid) values(%(gid)s, %(uid)s) '''
        args = {'uid':uid,'gid':gid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除用户组所有用户
# @author peter
# @table pw_usergroupitem
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delUserGroupitem(action=None, uid=None, gid=None):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if action =='0':
            sql ='''delete from pw_usergroupitem where au_userid=%(uid)s'''
            args = {'uid':uid}
        elif action=='1':
            sql ='''delete from pw_usergroupitem where au_groupid=%(gid)s'''
            args = {'gid':gid}
        elif action=='2':
            sql ='''delete from pw_usergroupitem where au_userid = %(uid)s and au_groupid= %(gid)s'''
            args = {'uid':uid,'gid':gid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 更新导航排序
# @author peter
# @table pw_treenav
# @sqltype update
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def setTreeNavOrder(rootid, orderid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''update pw_treenav set at_orderno = at_orderno + 1 where at_rootid = %(rootid)s and at_orderno > %(orderid)s '''
        args = {'rootid':rootid,'orderid':orderid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除导航
# @author peter
# @table pw_treenav
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delTreeNav(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_treenav where at_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 设置classpath
# @author peter
# @table pw_treenav
# @sqltype update
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def setTreeNavClasspath(tid,classpath,divno=''):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if len(divno)>0 and divno.isdigit():
            sql ='''update pw_treenav set at_classpath = %(classpath)s,at_divno = %(divno)s where at_id = %(tid)s'''
            args = {'classpath':classpath,'tid':tid,'divno':divno}
        else:
            sql='''update pw_treenav set at_classpath = %(classpath)s where at_id = %(tid)s'''
            args = {'classpath':classpath,'tid':tid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 添加删除在线表
# @author peter
# @table pw_online
# @sqltype delete,insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def modifyUserOnline(action,userid='',ip='',pwd='',ids=''):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if action=='0':
            sql='''insert into pw_online (ao_userid,ao_ip,ao_pwd) values (%(userid)s,%(ip)s,%(pwd)s)'''
            args = {'userid':userid,'ip':ip,'pwd':pwd}
        elif action=='-1':
            if len(pwd)<=0 and len(ids)<=0:
                sql = '''delete from pw_online where to_days(now())-to_days(ao_date)>0.5'''
                args = {}
            elif len(pwd)>0:
                sql = '''delete from pw_online where ao_userid =%(userid)s and ao_pwd=%(pwd)s '''
                args = {'userid':userid,'pwd':pwd}
            elif len(ids)>0:
                sql ='''delete from pw_online where ao_userid in ('''+ids+''') '''
                args = {}

        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除类型名称
# @author peter
# @table  delCategory
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delCategory(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_category where ac_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除类型名称
# @author peter
# @table  delCategory
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delWebsite(ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete pw_site where aw_id in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除权限树
# @author peter
# @table  pw_permission_treenav
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delpermissiontree(uid,sid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''delete from pw_permission_treenav where pn_siteid= %(s_id)s and pn_userid = %(u_id)s '''
        args = {'u_id':uid,'s_id':sid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 用户权限ID，节点ID写入关联数组pw_permissiontreenav
# @author peter
# @table  pw_permission_treenav
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def insertPermissionTree(uid,nid,sid,pid):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''INSERT INTO pw_permission_treenav(pn_userid,pn_treenavid,pn_siteid,pn_permissionid) VALUES (%(u_id)s,%(nid)s,%(s_id)s,%(pid)s)'''
        args = {'u_id':uid,'nid':nid,'s_id':sid,'pid':pid}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 删除用户XML权限列表pw_permission_treenav
# @author peter
# @table  pw_permission_treenav
# @sqltype delete
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def delUserXml(state,ids):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if state=='1':
            sql ='''delete from pw_permission_treenav where pn_userid in ('''+ids+''') '''
        elif state=='2':
            sql ='''delete from pw_permission_treenav where pn_permissionid in ('''+ids+''') '''
        elif state =='3':
            sql ='''delete from pw_permission_treenav where pn_treenavid in ('''+ids+''') '''
        args = {}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 新增站点
# @author peter
# @table  pw_pokerdept_site
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def insertDeptSite(deptid,siteid,xmlpath):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql ='''select count(*) cnt from pw_pokerdept_site where sd_dpid= %(deptid)s and sd_siteid= %(siteid)s '''
        args = {'deptid':deptid,'siteid':siteid}
        ret = db.query(sql,args)
        
        cnt = int(ret[0].get('cnt'))

        if cnt <= 0:
            isql = '''insert into pw_pokerdept_site(sd_dpid, sd_siteid, sd_xmlurl) values (%(deptid)s,%(siteid)s,%(xmlpath)s)'''
            iargs={'deptid':deptid,'siteid':siteid,'xmlpath':xmlpath}
            ret = db.execute(isql, iargs)
            if ret:
                db.commit()
            else:
                db.rollback()
                resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 修改类别信息
# @author peter
# @table  pw_category
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyCategoryInfo(action,catename,cateremark,siteid,acid):
def modifyCategoryInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    
    action = kwargs.get('action')

    try:
        if action=='0':
            sql = '''insert into pw_category(ac_name,ac_remark,ac_siteid) values(%(catename)s,%(cateremark)s,%(siteid)s) '''
            args={ 'catename'  : kwargs.get('catename'),
                   'cateremark': kwargs.get('cateremark'),
                   'siteid'    : kwargs.get('siteid')}
        elif action=='1':
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None

            sql = '''update pw_category 
                     set ac_siteid = ifnull(%(siteid)s,ac_siteid),
                         ac_name   = ifnull(%(catename)s,ac_name),
                         ac_remark = ifnull(%(cateremark)s,ac_remark)
                     where ac_id = %(acid)s '''
            args={ 'catename'  : kwargs.get('catename'),
                   'cateremark': kwargs.get('cateremark'),
                   'siteid'    : kwargs.get('siteid'),
                   'acid'      : kwargs.get('acid')}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 修改管理员帐号信息
# @author peter
# @table pw_treenav
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyTreeNavInfo(action,parentid,name,displayorderno,path,isshow,rootid,divno,orderno,classpath,ids):
def modifyTreeNavInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    action = kwargs.get('action')

    try:
        if action=='0':
            sql = '''insert into pw_treenav(at_parentid,at_name,at_displayOrderNo,at_path,at_isshow,at_rootid,at_divno,at_orderno,at_classpath)
                                  values(%(parentid)s,%(name)s,%(displayorderno)s,%(path)s,%(isshow)s,%(rootid)s,%(divno)s,%(orderno)s,%(classpath)s) '''
            args={ 'parentid'      : kwargs.get('parentid'),
                   'name'          : kwargs.get('name'),
                   'displayorderno': kwargs.get('displayorderno'),
                   'path'          : kwargs.get('path'),
                   'isshow'        : kwargs.get('isshow'),
                   'rootid'        : kwargs.get('rootid'),
                   'divno'         : kwargs.get('divno'),
                   'orderno'       : kwargs.get('orderno'),
                   'classpath'     : kwargs.get('classpath')
                   }
        elif action=='1':
            #将前端传过来的''转化为None，便于ifnull判断
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None
            
            sql = '''update pw_treenav 
                     set at_parentid      = ifnull(%(parentid)s,at_parentid), 
                        at_name           = ifnull(%(name)s, at_name),
                        at_displayorderno = ifnull(%(displayorderno)s, at_displayorderno),
                        at_path           = ifnull(%(path)s, at_path), 
                        at_isshow         = ifnull(%(isshow)s, at_isshow), 
                        at_classpath      = ifnull(%(classpath)s, at_classpath) 
                     where at_id in (%(ids)s) 
                    '''
            args={ 'parentid'      : kwargs.get('parentid'),
                   'name'          : kwargs.get('name'),
                   'displayorderno': kwargs.get('displayorderno'),
                   'path'          : kwargs.get('path'),
                   'isshow'        : kwargs.get('isshow'),
                   'classpath'     : kwargs.get('classpath'),
                   'ids'           : kwargs.get('ids')
                   }

        ret = db.execute(sql,args)
        logging.info('%s' %ret)
        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 修改类别信息
# @author peter
# @table  pw_category
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyWebsiteInfo(action,siteid,sitename,staticpath,siteurl):
def modifyWebsiteInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    action = kwargs.get('aciton')

    try:
        if action=='0':
            sql = '''insert into pw_site(aw_id, aw_sitename ,aw_staticpath, aw_siteurl) values(%(siteid)s ,%(sitename)s, %(staticpath)s, %(siteurl)s)'''
            args={ 'siteid'    : kwargs.get('siteid'),
                   'sitename'  : kwargs.get('sitename'),
                   'staticpath': kwargs.get('staticpath'),
                   'siteurl'   : kwargs.get('siteurl')}
            ret = db.execute(sql,args)
            if ret:
                db.commit()
            else:
                db.rollback()

            sql='''insert into pw_treenav(at_id ,at_parentid,at_name ,at_displayorderno,at_path,at_isshow ,at_rootid ,at_divno ,at_orderno,at_date ,at_classpath) 
                      values(%(atid)s ,%(parentid)s ,%(name)s ,%(displayorderno)s,%(path)s ,%(isshow)s ,%(rootid)s ,%(divno)s ,%(orderno)s,now() ,%(classpath)s) '''
            args={ 'atid'          : kwargs.get('siteid'),
                   'parentid'      :'0',
                   'name'          : kwargs.get('sitename'),
                   'displayorderno': '0',
                   'path'          : '',
                   'isshow'        : '1',
                   'rootid'        : '0',
                   'divno'         : '0',
                   'orderno'       : '0',
                   'classpath'     : ''
                 }
            ret = db.execute(sql,args)
            if ret:
                db.commit()
            else:
                db.rollback()
                resp['CODE'] = str(retcode.SYSTEM_FAIL)
            return resp
        elif action=='1':
            #将前端传过来的''转化为None，便于ifnull判断
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None
            
            siteid = kwargs.get('siteid')
            sql = '''update pw_site 
                     set aw_sitename   = ifnull(%(sitename)s, aw_sitename), 
                         aw_staticpath = ifnull(%(staticpath)s, aw_staticpath),
                         aw_siteurl    = ifnull(%(siteurl)s, aw_siteurl)
                     where aw_id in ('''+siteid+ ''') '''
            args={ 'sitename'  : kwargs.get('sitename'),
                   'staticpath': kwargs.get('staticpath'),
                   'siteurl'   : kwargs.get('siteurl')
                 }
            ret = db.execute(sql,args)
            if ret:
                db.commit()
            else:
                db.rollback()

            sql = '''update pw_treenav set at_name=%(sitename)s where at_id=%(siteid)s and at_parentid=0 '''
            args={ 'sitename': kwargs.get('sitename'),
                   'siteid'  : kwargs.get('siteid')
                 }
            ret = db.execute(sql,args)
            if ret:
                db.commit()
            else:
                db.rollback()
                resp['CODE'] = str(retcode.SYSTEM_FAIL)
            return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 修改管理员帐号信息
# @author peter
# @table  pw_admin
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyAdminInfo(action,ids=None,parent=None,username=None,userpwd=None,truename=None,
#                    ispass=None,lastip=None,xmlpath=None,depart=None,admintype=None,
#                    ap500user=None,usergroup=None,tmppwd=None,oldpwd=None,
#                    parentid=None,opadmin=None,mobile=None):
def modifyAdminInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    action = kwargs.get('action', '1')
    ids    = kwargs.get('ids', '0')

    try:
        if action=='0':
            sql = '''insert into pw_admin(ap_parentid,ap_username,
                     ap_userpwd,ap_truename,ap_date,ap_lastdate,
                     ap_ispass,ap_lastip,ap_xmlpath,ap_department,
                     ap_admintype,ap_500user,ap_mobile) values
                     (%(parent)s,%(username)s,%(userpwd)s,%(truename)s,now(),now(),%(ispass)s,%(lastip)s,%(xmlpath)s,%(depart)s,%(admintype)s,%(ap500user)s,%(mobile)s) '''
            args={'parent' :kwargs.get('parent'),
                 'username':kwargs.get('username'),
                 'userpwd' :kwargs.get('userpwd'),
                 'truename':kwargs.get('truename'),
                 'ispass'  :kwargs.get('ispass'),
                 'lastip'  :kwargs.get('lastip'),
                 'xmlpath' :kwargs.get('xmlpath'),
                 'depart'  :kwargs.get('depart'),
                 'admintype':kwargs.get('admintype'),
                 'ap500user':kwargs.get('ap500user'),
                 'mobile'   :kwargs.get('mobile')}

        elif action=='1':
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None

            sql = '''update pw_admin 
                     set ap_truename = ifnull(%(truename)s, ap_truename), ap_pwdtime = now(),
                         ap_ispass   = ifnull(%(ispass)s, ap_ispass),    
                         ap_username = ifnull(%(username)s, ap_username),
                         ap_userpwd  = ifnull(%(userpwd)s, ap_userpwd), 
                         ap_parentid = ifnull(%(parentid)s,ap_parentid),
                         ap_lastip   = ifnull(%(lastip)s, ap_lastip),ap_lastdate=now(),
                         ap_xmlpath  = ifnull(%(xmlpath)s, ap_xmlpath),
                         ap_tmppwd   = ifnull(%(tmppwd)s, ap_tmppwd),
                         ap_oldpwd   = ifnull(%(oldpwd)s,ap_oldpwd),
                         ap_opadmin  = ifnull(%(opadmin)s, ap_opadmin),
                         ap_department=ifnull(%(depart)s,ap_department),
                         ap_admintype =ifnull(%(admintype)s,ap_admintype),
                         ap_usergroup =ifnull(%(usergroup)s,ap_usergroup),
                         ap_500user   =ifnull(%(ap500user)s,ap_500user),
                         ap_mobile    =ifnull(%(mobile)s, ap_mobile)
                     where ap_id in ('''+ids+''') '''
            args ={'truename':kwargs.get('truename'), 
                   'ispass'  :kwargs.get('ispass'), 
                   'username':kwargs.get('username'), 
                   'userpwd' :kwargs.get('userpwd'),
                   'parentid':kwargs.get('parentid'), 
                   'lastip'  :kwargs.get('lastip'), 
                   'xmlpath' :kwargs.get('xmlpath'), 
                   'tmppwd'  :kwargs.get('tmppwd'),
                   'oldpwd'  :kwargs.get('oldpwd'),
                   'opadmin' :kwargs.get('opadmin'),
                   'depart'  :kwargs.get('depart'),
                   'admintype':kwargs.get('admintype'),
                   'usergroup':kwargs.get('usergroup'),
                   'ap500user':kwargs.get('ap500user'),
                   'mobile'   :kwargs.get('mobile')}
        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp



# 修改管理管理组信息
# @author peter
# @table  pw_admin
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyGroupInfo(action,name,about,parent,siteid,parentid,ids):
def modifyGroupInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    action = kwargs.get('action')
    try:
        if action=='0':
            sql = '''insert into pw_permissiongroup(ag_name,ag_about,ag_date,ag_parentid,ag_siteid)
                          values(%(name)s,%(about)s,now(),%(parent)s,%(siteid)s) '''
            args={ 'name'  : kwargs.get('name'),
                   'about' : kwargs.get('about'),
                   'parent': kwargs.get('parent'),
                   'siteid': kwargs.get('siteid')
                  }
        elif action=='1':
            #将前端传过来的''转化为None，便于ifnull判断
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None
            
            ids = kwargs.get('ids')
            sql = '''update pw_permissiongroup 
                     set ag_parentid = ifnull(%(parentid)s, ag_parentid),
                         ag_name     = ifnull(%(name)s, ag_name),
                         ag_about    = ifnull(%(about)s, ag_about)
                     where ag_id in ('''+ids+''') '''
            args={ 'parentid': kwargs.get('parentid'),
                   'name'    : kwargs.get('name'),
                   'about'   : kwargs.get('about')
                 }

        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()

        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 修改权限信息
# @author peter
# @table  pw_permission
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#def modifyPermissionInfo(action,apid,name,about,siteid,cateid,treenavid,ids):
def modifyPermissionInfo(*largs, **kwargs):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    action = kwargs.get('action')
    try:
        if action=='0':
            sql = '''insert into pw_permission(ap_id,ap_name,ap_about,ap_date,ap_siteid,ap_cateid,ap_treenavid) values
                                  (%(apid)s,%(name)s,%(about)s,now(),%(siteid)s,%(cateid)s,%(treenavid)s) '''
            args={ 'apid'     : kwargs.get('apid'),
                   'name'     : kwargs.get('name'),
                   'about'    : kwargs.get('about'),
                   'siteid'   : kwargs.get('siteid'),
                   'cateid'   : kwargs.get('cateid'),
                   'treenavid': kwargs.get('treenavid')
                 }
        elif action=='1':
            #将前端传过来的''转化为None，便于ifnull判断
            for k,v in kwargs.items():
                if v == '':
                    kwargs[k] = None
            
            ids = kwargs.get('ids')
            sql = '''update pw_permission 
                     set ap_name    = ifnull(%(apname)s, ap_name), 
                         ap_about   = ifnull(%(about)s,ap_about),
                         ap_cateid  = ifnull(%(cateid)s,ap_cateid)
                   where ap_id in ('''+ids+''') 
                  '''
            args={ 'apname': kwargs.get('name'),
                   'about' : kwargs.get('about'),
                   'cateid': kwargs.get('cateid')
                 }

        ret = db.execute(sql,args)

        if ret:
            db.commit()
        else:
            db.rollback()

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 在节点上增加、删除权限(用于将已添加权限挂到叶子节点上)
# @author peter
# @table  pw_permission
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def modifyNodeByPid(pids,sid,nid,action):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        if action=='1':
            usql = '''update pw_permission set ap_treenavid = '' where ap_treenavid = %(nid)s and ap_siteid = %(sid)s'''
            uargs={'nid':nid,'sid':sid}
            ret = db.execute(usql,args)
            if ret:
                db.commit()
            else:
                db.rollback()
                resp['CODE'] = str(retcode.SYSTEM_FAIL)
                return resp

        usql ='''update pw_permission set ap_treenavid = %(nid)s where ap_id in('''+pids+''') and ap_siteid = %(sid)s '''
        uargs={'nid':nid,'sid':sid}

        ret = db.execute(sql,args)
        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取管理员列表
# @author peter
# @table manweb_pw_getadminlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表

def getAdminList(action,parentid, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    offset = int(offset)
    limit  = int(limit)

    try:
        if findstr == None or len(findstr) <= 0:
            if action == '0':
                sql       = ''' select count(*) cnt from pw_admin '''
                args ={}

                sql1 = '''
                      select   a.ap_id as id, a.ap_parentid as parentid, a.ap_username as username,
                               a.ap_truename as truename, a.ap_date as createdate, a.ap_lastdate as lastdate,
                               a.ap_lastip as lastip, a.ap_ispass as ispass, a.ap_xmlpath as xmlpath,
                               b.ap_username as parentname
                      from pw_admin a left join pw_admin b on a.ap_parentid = b.ap_id
                      order by a.ap_ispass desc, a.ap_truename
                      limit %(offset)s, %(limit)s
                      '''
                args1 = {'offset':offset, 'limit':limit}
            elif action == '1':
                sql = '''
                      select count(*) cnt
                      from   pw_admin
                      where  (ap_parentid = %(parentid)s or ap_id = %(parentid)s);
                      '''
                args = {'parentid':parentid}

                sql1 = '''
                      select   a.ap_id as id, a.ap_parentid as parentid, a.ap_username as username,
                               a.ap_truename as truename, a.ap_date as createdate, a.ap_lastdate as lastdate,
                               a.ap_lastip as lastip, a.ap_ispass as ispass, a.ap_xmlpath as xmlpath,
                               b.ap_username as parentname
                      from  pw_admin a left join pw_admin b on a.ap_parentid = b.ap_id
                      where (a.ap_parentid = %(parentid)s or a.ap_id = %(parentid)s)
                      order by a.ap_ispass desc, a.ap_truename
                      limit %(offset)s, %(limit)s
                      '''
                arg1 = {'parentid':parentid,'offset':offset, 'limit':limit}
        else:
            if action == '0':
                sql = '''
                           select count(*) cnt
                           from   pw_admin
                           where  ap_username like %(findstr)s or ap_truename like %(findstr)s 
                      '''
                args = {'findstr':'%' + findstr}

                sql1 = '''
                          select   a.ap_id as id, a.ap_parentid as parentid, a.ap_username as username,
                                   a.ap_truename as truename, a.ap_date as createdate, a.ap_lastdate as lastdate,
                                   a.ap_lastip as lastip, a.ap_ispass as ispass, a.ap_xmlpath as xmlpath,
                                   b.ap_username as parentname
                         from  pw_admin a left join pw_admin b on a.ap_parentid = b.ap_id
                         where a.ap_username like %(findstr)s or a.ap_truename like %(findstr)s
                         order by a.ap_ispass desc, a.ap_truename
                         limit %(offset)s, %(limit)s
                     '''
                args1 = {'findstr':'%' + findstr, 'offset':offset, 'limit':limit}
            elif action == '1':
                args = {'findstr':'%' + findstr, 'parentid':parentid}
                sql = '''
                        select count(*) cnt
                        from   pw_admin
                        where ap_username like %(findstr)s or ap_truename like %(findstr)s
                             and ap_parentid = %(parentid)s or ap_id = %(parentid)s
                     '''
                logging.info('%s' %args)
                logging.info('%s' %sql)
                

                sql1 = '''
                      select   a.ap_id as id, a.ap_parentid as parentid, a.ap_username as username,
                               a.ap_truename as truename, a.ap_date as createdate, a.ap_lastdate as lastdate,
                               a.ap_lastip as lastip, a.ap_ispass as ispass, a.ap_xmlpath as xmlpath,
                               b.ap_username as parentname
                      from     pw_admin a left join pw_admin b on a.ap_parentid = b.ap_id
                      where (a.ap_username like %(findstr)s or a.ap_truename like %(findstr)s)
                           and (a.ap_parentid = %(parentid)s or a.ap_id = %(parentid)s)
                      order by a.ap_ispass desc, a.ap_truename
                      limit %(offset)s, %(limit)s
                  '''
                args1 = {'findstr':'%' + findstr, 'parentid':parentid, 'offset':offset, 'limit':limit}
        
        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args1)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 获取部门用户列表
# @author peter
# @table  manweb_pw_getadminlist_s
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getAdminLists(action,admintype,deptid, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql  = '''select count(*) cnt from pw_admin where %s'''

        sql1 = '''
              select a.ap_id as id, a.ap_parentid as parentid, a.ap_username as username, a.ap_truename as truename,
                     a.ap_date as createdate, a.ap_lastdate as lastdate, a.ap_lastip as lastip, a.ap_ispass as ispass,
                     a.ap_xmlpath as xmlpath, b.ap_username as parentname, a.ap_admintype as admintype, a.ap_department as department,
                     a.ap_500user as authuser ,a.ap_mobile as  mobiles
              from pw_admin a left join pw_admin b on a.ap_parentid = b.ap_id where %s 
              '''

        where  = ' 1 = 1'
        where1 = ' 1 = 1'
        args  = {}
        
        if action:
            where  += ' and ap_ispass = %(action)s' 
            where1 += ' and a.ap_ispass = %(action)s' 
            args['action'] = action
        if admintype:
            where  += ' and ap_admintype = %(admintype)s' 
            where1 += ' and a.ap_admintype = %(admintype)s' 
            args['admintype'] = admintype
        if deptid:
            where  += ' and ap_department = %(deptid)s' 
            where1 += ' and a.ap_department = %(deptid)s'
            args['deptid'] = deptid
        if findstr:
            where  += ' and (ap_username like %(findstr)s or ap_truename like %(findstr)s or ap_mobile like %(findstr)s or ap_500user like %(findstr)s) ' 
            where1 += ' and (a.ap_username like %(findstr)s or a.ap_truename like %(findstr)s or a.ap_mobile like %(findstr)s or a.ap_500user like %(findstr)s) ' 
            args['findstr'] = '%' + findstr
        
        where1 += ' order by a.ap_ispass desc, a.ap_truename limit %(offset)s, %(limit)s '
        args['offset'] = int(offset)
        args['limit']  = int(limit)
        sql  = sql%where
        sql1 = sql1%where1
        
        logging.info('%s' %sql)
        logging.info('%s' %sql1)

        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 取管理组列表
# @author peter
# @table  manweb_pw_getgrouplist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getGroupList(action,parentid, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql = '''select count(*) cnt from pw_permissiongroup where %s
              '''
        sql1 = '''
                select a.ag_id       as id,
                       a.ag_parentid as parentid,
                       a.ag_name     as name,
                       a.ag_about    as about,
                       a.ag_date     as createdate,
                       a.ag_siteid   as siteid,
                       a.ag_name     as parentName,
                       c.aw_sitename as sitename
               from pw_permissiongroup a left join pw_site c on a.ag_siteid = c.aw_id 
               where %s
             '''
        where  = '1 = 1'
        where1 = '1 = 1'
        args = {}
        if findstr == None or len(findstr) <= 0:
            if action == '1':
                where += ' and ag_parentid = %(parentid)s or ag_id = %(parentid)s '
                where1 += ' and a.ag_parentid = %(parentid)s or a.ag_id = %(parentid)s '
                args['parentid'] = parentid
        else:
            if action == '0':
                where  += ' and ag_name like %(findstr)s '
                where1 += ' and a.ag_name like %(findstr)s '
                args['findstr'] = '%' + findstr
            elif action == '1':
                where  += ' and ag_name like %(findstr)s and (ag_parentid = %(parentid)s or ag_id = %(parentid)s) '
                where1 += ' and a.ag_name like %(findstr)s and (a.ag_parentid = %(parentid)s or a.ag_id = %(parentid)s) '
                args['findstr'] = '%' + findstr
                args['parentid'] = parentid

        where1 += ' order by c.aw_id,a.ag_id asc limit %(offset)s, %(limit)s'
        args['offset'] = int(offset)
        args['limit']  = int(limit)
        
        sql  = sql%where
        sql1 = sql1%where1
        logging.debug('%s' %sql)
        logging.debug('%s' %sql1)
        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 取权限列表
# @author peter
# @table  manweb_pw_getpermissionlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getPermissionList(action,zhandian, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql = '''select count(*) cnt from pw_permission where %s
              '''

        sql1 = '''
                select ap_id    as id,
                       ap_name  as name,
                       ap_about as about,
                       ap_siteid  as siteid,
                       ap_date  as createdate,
                       aw_sitename as sitename
                from pw_permission a
                     left join pw_site b on a.ap_siteid = b.aw_id 
               where %s
             '''
        where  = '1 = 1'
        where1 = '1 = 1'
        args = {}
        if findstr and len(findstr) > 0:
            if action == '0':
                where  += ' and ap_siteid = %(siteid)s and (ap_name like %(findstr)s or ap_id like %(findstr)s) '
                where1 = where
                args['findstr'] = '%' + findstr
                args['siteid']  = zhandian

        where1 += ' order by ap_id asc limit %(offset)s, %(limit)s'
        args['offset'] = int(offset)
        args['limit']  = int(limit)
        
        sql  = sql%where
        sql1 = sql1%where1
        logging.debug('%s' %sql)
        logging.debug('%s' %sql1)
        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 取权限列表
# @author peter
# @table  manweb_pw_getpermissionlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getPermissionLists(action,zhandian,sitelist, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql = '''select count(*) cnt from pw_permission where %s
              '''

        sql1 = '''
                select  ap_id       as id,
                        ap_name     as name,
                        ap_about    as about,
                        ap_date     as createdate,
                        aw_sitename as sitename,
                        ap_siteid   as siteid
                from pw_permission a
                left join pw_site b on a.ap_siteid = b.aw_id 
                where %s
             '''
        where  = '1 = 1'
        where1 = '1 = 1'
        args = {}
        if findstr is None or len(findstr) <= 0:
            if sitelist or len(sitelist) > 0:
                where  += ' and ap_siteid in (' + sitelist + ') '
                where1 = where
        else:
                where  += ' and ap_siteid in (' + sitelist + ') and (ap_name like %(findstr)s or ap_id like  %(findstr)s) '
                where1 = where
                args['findstr'] = '%' + findstr
        where1 += ' order by ap_id asc limit %(offset)s, %(limit)s'
        args['offset'] = int(offset)
        args['limit']  = int(limit)
        
        sql  = sql%where
        sql1 = sql1%where1
        logging.debug('%s' %sql)
        logging.debug('%s' %sql1)
        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过权限ID查找具有该权限组用户
# @author peter
# @table  manweb_pw_getpermissionlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getGroupListByUid(action,uid, offset,limit,findstr):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql = '''
                select count(*) cnt
                from pw_permissiongroup
                where ag_parentid in (select au_groupid
                                      from pw_usergroupitem
                                      where au_userid = %(userid)s)
                         or ag_id in (select au_groupid
                                      from pw_usergroupitem
                                      where au_userid = %(userid)s)
              '''
            
        sql1 = '''
                select ag_id as id, ag_parentid as parentid,
                       ag_name as name, ag_about as about,
                       ag_date as createdate
                from pw_permissiongroup
                where ag_parentid in (select au_groupid
                                      from pw_usergroupitem
                                      where au_userid = %(userid)s)
                      or ag_id    in (select au_groupid
                                      from pw_usergroupitem
                                      where au_userid = %(userid)s)
               '''
        if findstr == None or len(findstr) <= 0:
            sql1 += ' order by createdate '
            args = {'userid' : uid }
        else:
            sql1 += ' and ag_name like %(findstr)s order by createdate '
            sql += ' and ag_name like %(findstr)s  '
            args = {'userid':uid, 'findstr':findstr}

        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过组ID列表 获取所有组权限列表
# @author peter
# @table  manweb_pw_getpermissionlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getPermissionListByGidsi(gids, offset,limit):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql = '''select a.ap_id as id,
              a.ap_name as name,
              a.ap_about as about 
              from pw_permission a join pw_groupitem b on a.ap_id = b.ag_permissionid 
              where b.ag_groupid in ('''+gids+''')'''
        sql_count = '''select count(1) as allcount
              from pw_permission a join pw_groupitem b on a.ap_id = b.ag_permissionid 
              where b.ag_groupid in ('''+gids+''')'''
        args = {}
        ret_count = db.query(sql_count,args)
        ret       = db.query(sql, args)
        resp['info']['cnt'] = ret_count[0]['allcount']
        resp['list'].append(ret[0])

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 通过组ID列表 获取所有组权限列表
# @author peter
# @table  manweb_pw_getTreeNavlist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getTreeNavList(action,parentid,findstr, offset,limit):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        sql = '''
                select count(*) cnt from pw_treenav where %s
              '''
            
        sql1 = '''
                select at_id             as id,
                       at_parentid       as parentid,
                       at_name           as name,
                       at_displayorderno as displayorderno,
                       at_path           as path,
                       at_isshow         as isshow,
                       at_rootid         as rootid,
                       at_divno          as divno,
                       at_orderno        as orderno,
                       at_date           as createdate,
                       at_classpath      as classpath
               from pw_treenav where %s
               '''
        where =  '1 = 1'
        where1 = '1 = 1'
        if findstr == None or len(findstr) <= 0:
            if action == '0':
                where1 += 'order by at_id asc limit %(offset)s, %(limit)s '
                args = {'offset':int(offset), 'limit':int(limit)}
            elif action == '1':
                where  += ' and at_parentid = %(parentid)s'
                where1 += ' and at_parentid = %(parentid)s order by at_parentid, at_displayorderno desc, at_id asc limit %(offset)s, %(limit)s'
                args = {'parentid':parentid, 'offset':int(offset), 'limit':int(limit)}
            elif action == '2':
                where1 += ' order by at_parentid, at_displayorderno desc, at_id asc limit %(offset)s, %(limit)s '
                args = {'offset':int(offset), 'limit':int(limit)}
        else:
            if action == '0':
                where  += ' and at_name like %(findstr)s '
                where1 += ' and at_name like %(findstr)s order by at_id asc limit %(offset)s, %(limit)s '
                args = {'findstr':'%'+findstr, 'offset':int(offset), 'limit':int(limit)}
            elif action == '1':
                where  += ' and at_parentid = %(parentid)s and at_name like %(findstr)s'
                where1 += ' and at_parentid = %(parentid)s and at_name like %(findstr)s order by at_parentid, at_displayorderno desc, at_id asc limit %(offset)s, %(limit)s'
                args = {'findstr':'%'+findstr, 'parentid':parentid, 'offset':int(offset), 'limit':int(limit)}
            elif action == '2':
                where  += ' and at_name like %(findstr)s '
                where1 += ' and at_name like %(findstr)s order by at_parentid, at_displayorderno desc, at_id asc limit %(offset)s, %(limit)s '
                args = {'findstr':'%'+findstr, 'offset':int(offset), 'limit':int(limit)}
        
        sql = sql % where
        sql1 = sql1 % where
        ret_cnt = db.query(sql, args)
        cnt     = ret_cnt[0].get('cnt')
        resp['info']['cnt'] = str(cnt)

        ret = db.query(sql1,args)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))

        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 取站点
# @author peter
# @table  getWebsiteList
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getWebsiteList(action,findstr, offset,limit):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        if action == '0':
            sql = '''select count(*) cnt from pw_site where %s
                  '''

            sql1 = '''
                    select aw_id     as id,
                       aw_sitename   as sitename,
                       aw_staticpath as staticpath,
                       aw_siteurl    as siteurl
                    from pw_site 
                    where %s
                 '''
            where  = '1 = 1'
            where1 = '1 = 1'
            args = {}
            if findstr and len(findstr) > 0:
                where  += ' and aw_sitename like %(findstr)s '
                where1 += ' and aw_sitename like %(findstr)s order by aw_id asc limit %(offset)s, %(limit)s'
                args = {'findstr':'%'+findstr, 'offset':int(offset), 'limit':int(limit)}

            sql  = sql%where
            sql1 = sql1%where1
            logging.debug('%s' %sql)
            logging.debug('%s' %sql1)
            ret_cnt = db.query(sql, args)
            cnt     = ret_cnt[0].get('cnt')
            resp['info']['cnt'] = str(cnt)

            ret = db.query(sql1,args)
            for d in ret:
                resp['list'].append(Common.mapMembers2str(d))
            return resp
        else:
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
            return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取功能类别
# @author peter
# @table  manweb_pw_categorylist
# @sqltype procedure
# @return CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
#         list 字典列表
def getCategoryListInfo(action,findstr, offset,limit):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }

    try:
        if action == '0':
            sql = '''select count(*) cnt from pw_category where %s
                  '''

            sql1 = '''
                    select ac_id     as id,
                           ac_name   as catename,
                           ac_remark as remark,
                           ac_siteid as siteid
                    from pw_category 
                    where %s
                 '''
            where  = '1 = 1'
            where1 = '1 = 1'
            args = {}
            if findstr and len(findstr) > 0:
                where  += ' and ac_name like %(findstr)s '
                where1 += ' and ac_name like %(findstr)s order by ac_id asc limit %(offset)s, %(limit)s'
                args = {'findstr':'%'+findstr, 'offset':int(offset), 'limit':int(limit)}

            sql  = sql%where
            sql1 = sql1%where1
            logging.debug('%s' %sql)
            logging.debug('%s' %sql1)
            ret_cnt = db.query(sql, args)
            cnt     = ret_cnt[0].get('cnt')
            resp['info']['cnt'] = str(cnt)

            ret = db.query(sql1,args)
            for d in ret:
                resp['list'].append(Common.mapMembers2str(d))
            return resp
        else:
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
            return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


##
# 根据手机号码查询用户名
# @author liub
# @return dict 列表
# CODE 返回码 >0成功  <0失败
# MSG 返回信息
# info 字典 为空
# list 字典列表
#
def getPwadminMobile(mobile):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql = ''' select   ap_id as id,
                           ap_parentid as parentid,
                           ap_username as username,
                           ap_userpwd as userpwd,
                           ap_truename as truename,
                           ap_date as createdate,
                           ap_lastdate as lastdate,
                           ap_ispass as ispass,
                           ap_lastip as lastip,
                           ap_xmlpath as xmlpath,
                           ap_tmppwd as tmppwd,
                           to_days(now())-to_days(ap_pwdtime) as day,
                           ap_oldpwd,
                           ap_opadmin,
                           ap_department as department,
                           ap_admintype as admintype,
                           ap_500user as authuser,
                           ap_mobile as mobile 
                      from pw_admin where ap_mobile = %(mobile)s'''
        args = dict()
        args['mobile'] = mobile
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

def insfingerpring(username,fingerprint,verify):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql='''insert into pw_authid(f_username,f_fingerprint,f_verify,f_addtime)
                   values(%(username)s, %(fingerprint)s, %(verify)s, now())'''
        args={'username':username,'fingerprint':fingerprint,'verify':verify}
        ret = db.execute(sql,args)
        if ret:
            db.commit()
        else:
            db.rollback()
            resp['CODE'] = str(retcode.SYSTEM_FAIL)
        
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

def queryfingerpring(username,fingerprint):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql='''select count(*) cnt from pw_authid where f_fingerprint = %(fingerprint)s and f_username = %(username)s'''
        args={'username':username,'fingerprint':fingerprint}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

def queryfingerpringforUser(username):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        sql='''select count(*) cnt from pw_authid where f_username = %(username)s'''
        args={'username':username}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

# 查找部门管理员列表(根据用户类别 查找用户列表)
# @author peter
# @table  pw_userxml
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getDepartAdminList(admintype,dpid,offset,limit):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        args = {'admintype':admintype,'dpid':dpid}
        sqlcount = '''select count(*) cnt  
                      from (
                            select a.ap_id id,a.ap_username username,a.ap_truename truename,a.ap_department 
                                   dpid,a.ap_admintype admintype,b.d_department dpname 
                            from pw_admin a left join pw_pokerdept b 
                            on   a.ap_department = b.d_id 
                            where   (a.ap_admintype = %(admintype)s or %(admintype)s = '') 
                                and (a.ap_department = %(dpid)s or %(dpid)s = '')
                            ) as total
                   '''
        logging.info('%s' %sqlcount)
        retcnt = db.query(sqlcount, args)
        cnt = retcnt[0]['cnt']
        sql    = '''select a.ap_id id,a.ap_username username,a.ap_truename truename,a.ap_department 
                      dpid,a.ap_admintype admintype,b.d_department dpname from 
                  pw_admin a left join pw_pokerdept b on a.ap_department=b.d_id where (a.ap_admintype = %(admintype)s or %(admintype)s = '')
                  and  (a.ap_department = %(dpid)s  or %(dpid)s = '')'''
        ret = db.query(sql, args)

        resp['info']['cnt'] =str(cnt)
        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 获取部门列表
# @author peter
# @table  t_pokerdept
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getDepartmentListInfo(search):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        args = {}
        if search=='':
            sql ='''select * from pw_pokerdept order by d_id'''
            args={}
        else:
            sql ='''select * from pw_pokerdept where d_department= %(search)s order by d_id'''
            args = {'search':search}

        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp

##
# 查询部门列表
# @author peter
# @table pw_pokerdept
# @sqltype select
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def getDepartList(dept):
    global MYSQL_USER_CONFIG
    db = esunmysql.connect(MYSQL_USER_CONFIG)
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    try:
        args = {}
        sql ='''
              select * from pw_pokerdept where d_id= %(dept)s or %(dept)s = '' 
             '''
        args = {'dept':dept}
        ret = db.query(sql,args)

        for d in ret:
            resp['list'].append(Common.mapMembers2str(d))
        return resp
    except:
        logging.error(traceback.format_exc())
        resp['CODE'] = str(retcode.SYSTEM_FAIL)
        return resp


# 插入用户管理日志
# @author peter
# @table  b_adminlog
# @sqltype insert
# @return dict 列表
#         CODE 返回码 >0成功  <0失败
#         MSG 返回信息
#         info 字典 为空
def insertAdminLog(username,title,note):
    resp = {
            'CODE': str(retcode.SYSTEM_OK),
            'MSG': '',
            'info': dict(),
            'list': list()
          }
    return resp
#################################################
_LOCALS_ = locals()
def reg_interface(prefix):
    '''系统固定注册接口函数'''

    import types
    logging.info('starting register interface!')

    functions = {}

    for item in _LOCALS_.items():
        name = item[0].lower()
        name2= prefix.lower() + '_' + name
        obj  = item[1]
        #忽略自己
        if name in ["reg_interface", "load_module"]:
            continue
        # 忽略前缀是_的函数
        if len(name) > 0 and name[0] == "_":
            continue
        # 只取函数
        if type( obj ) == types.FunctionType:
            functions[ name ] = obj
            functions[ name2 ]= obj

    return functions
