#部署
##准备工作
* nginx配置
	** root地址配置到项目的public目录

##生成项目key并配置到.env中APP_KEY上
	* php artisan key:generate

##生成passport的key
	* php artisan passport:install
	* php artisan passport:keys
		** 如果失败执行php artisan passport:keys --force

##新建数据库
	* CREATE DATABASE `nova_auth` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci

##添加.env文件并修改配置

##执行数据迁移
	* php artisan migrate

##同步业务系统数据
	* 配置config/database.php文件的mysql_care为业务系统mysql配置
	* 执行数据填充
		** php artisan db:seeder

##安装前端资源
	* npm install
	* npm run dev

	

	
