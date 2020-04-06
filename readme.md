## THIS IS A PIPELINE FOR DEVELOPING MOC WEBSITE

### INTRODUCTION 
    
This is a mock MOC website on wordpress. After the set up, almost all administration can be done through its web frontend. In order to run wordpress locally we need L(inux)AMP or M(ac)AMP stack.(A)PACHE, (M)ySQL, (P)HP. Follow the steps to get wordpress installed locally 
    
     
 This git repo consists of the theme used to create the website. If you already have wordpress running locally skip to step 5.

###  STEP # 1 INSTALL Apache web server
        
        dnf install httpd -y  (Fedora)
        brew install httpd -y (Mac)
        
Now allow Apache through firewall in case fireall is running on your system. You might need to run the command with sudo privilages. Simply put sudo before the commands if needed. You'll need the password for sudo user.
        
        sudo firewall-cmd --add-port=80/tcp --permanent
        sudo firewall-cmd --reload
      
Start and enable Apache 
        
        sudo systemctl start httpd (fedora)
        sudo systemctl enable httpd (fedora)
        
        sudo brew services start httpd (Mac)
        
                                   
### STEP # 2 Install MySQL and run security script

        dnf install mysql mysql-server (fedora)
        brew install mysql-server (Mac)
        
Start and enable MySQL: 
        
        systemctl enable mariadb (fedora)
        systemctl start mariadb  (fedora)
        
        mysql.server start (Mac)
        brew services start mariadb (Mac)

Now run MySQL security script to set the root password, remove anonymous users, remove test databases,and disable remote login. If root password is already set enter the password instead of enter and do the rest of the steps. The script and the steps will be the same for both fedora and Mac.

        mysql_secure_installation

        Enter current password for root (enter for none): Press ENTER
        ...
        Set root password? [Y/n] <y>
        New password: <STRONGPASSWORD>
        Re-enter new password: STRONGPASSWORD
        ...
        Remove anonymous users? [Y/n] <y>.
        ...
        Disallow root login remotely? [Y/n] <y>
        ...
        Remove test database and access to it? [Y/n] <y>
        ...
        Reload privilege tables now? [Y/n] <y>
        
        
### STEP # 3 Installing PHP and Wordpress

fedora users:

         dnf install php php-fpm php-mysqlnd php-gd php-mcrypt php-mbstring
         dnf install wordpress
         
Mac users: 

         brew install php php-fpm php-mysqlnd php-gd php-mcrypt php-mbstring
         brew install wordpress

        
### STEP# 4 Create database for Wordpress.

Login to MariaDB using the password set in step 2.
        
        mysql -u root -p
        
Then use the following command to create Wordpress database

        create database mocsite;
        
Create Database user with all the privileges granted. After that, reload grant tables and quit.
User=Admin

        grant all privileges on mocsite.* to admin@localhost identified by 'PASSWORD';
        flush privileges;
        quit;
   
   
### STEP # 5 Configure database for Wordpress website

Here you'll have to go into the wp-config.php file of wordpress to configure the database you made in the above steps.
Navigate to wp-config.php. The path should be /wordpress/wp-config.php
      
        /** The name of the database for WordPress */
        define('DB_NAME', 'database_name_here');   [Change the database name made above. "mocsite"
 
         /** MySQL database username */
         define('DB_USER', 'username_here');        [Change the user name= Admin]
 
         /** MySQL database password */
         define('DB_PASSWORD', 'password_here');    [Change the password]

         /** MySQL hostname */
         define('DB_HOST', 'localhost');            [No change needed]
        
        
### STEP # 6 CLONE THIS GITHUB REPO IN YOUR WP-THEME
  
Here you'll have to go to themes directory of wordpress and clone this github reposiroty there. The path should be /wordpress/wp-content/themes
 
        git clone https://github.com/pkhander/MOC-pipeline_
        
        systemctl restart httpd (fedora)
        
        brew services restart httpd (mac)


### STEP # 7 READY TO GO 

        ON YOUR BROWSER: localhost/wordpress
        
Follow the steps to create a site. You now have a locally running wordpress. 
Choose the theme MOC-pipeline and now you are successfully running the latest MOC-WEBSITE 

### Step # 8 Import the pages and post of current MOC website

Follow the step here https://github.com/mAAdhaTTah/wordpress-github-sync to install and activate the github-sync plugin. 
After the plugin is installed go to your wordpress website -> Settings -> Github-sync -> import and import the _posts and _pages file.

Now you should have the latest MOC website on your local. 
