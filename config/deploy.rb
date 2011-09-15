# INITIAL CONFIGURATION
set :application, "llevatelos.com"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/jucedogi/llevatelos.com"

# ROLES
role :app, "llevatelos.com"
role :web, "llevatelos.com"
role :db, "llevatelos.com", :primary => true

# DREAMHOST INFORMATION
set :user, "jucedogi"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/subastas.git"
set :branch, "master"

# TASKS
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/jucedogi/llevatelos.com/current/app/. /home/jucedogi/llevatelos.com/app -R"
    run "cp /home/jucedogi/llevatelos.com/current/jars/. /home/jucedogi/llevatelos.com/jars -R"
    run "chmod 777 /home/jucedogi/llevatelos.com/app/tmp/ -R"
    run "chmod 777 /home/jucedogi/llevatelos.com/app/webroot/img/ -R"
  end
end