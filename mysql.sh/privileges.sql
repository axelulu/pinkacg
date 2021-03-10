use mysql;
-- 将docker_mysql数据库的权限授权给创建的docker用户，密码为123456：
update user set Host='%' where User='root';
-- 这一条命令一定要有：
flush privileges;
create database pinkacg;