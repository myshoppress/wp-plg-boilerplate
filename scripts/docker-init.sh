#!/usr/bin/env bash
set -euo pipefail

export NGINX_DOC_ROOT=$WP_ROOT/web
export HTTP_HOST="${HTTP_HOST:-app.localhost}"
export WP_ADMIN_USER=${WP_ADMIN_USER:-root}
export WP_ADMIN_PASS=${WP_ADMIN_PASS:-root}
export WP_SKELETON_VER=${WP_SKELETON_VER:-}

#add current working directory as local repository
composer --global config -n repositories.local path "$PWD"

#add any directory under pwd/projects/ as local repository
composer --global config -n repositories.local_projects path "$PWD/projects/*"

#create a composer.local.json file and symlink to $WP_ROOT/composer.local.json
#this allows to require packages for root without modifying $WP_ROOT/composer.json
if [[ ! -f ./projects/composer.local.json ]]; then
  touch ./projects/composer.local.json
  cat <<EOF > ./projects/composer.local.json
{
  "require-dev" : {

  },
  "require": {
    "roots/wordpress" : "${WP_VERSION:-5.7.1}"
  }
}
EOF
fi

if [[ ! -f $WP_ROOT/composer.json ]]; then
  if [[ -d $WP_ROOT ]]; then
    echo "$WP_ROOT already exists. Unable to create project. Please remove first." >&2
  else
    composer create-project --no-install --ignore-platform-reqs --remove-vcs -s dev -n -- myshoppress/wp-skeleton $WP_ROOT ${WP_SKELETON_VER:-}
    composer update -d $WP_ROOT
  fi
fi

ln -nsf $(pwd)/projects/composer.local.json $WP_ROOT/composer.local.json

function dump_env_file()
{
  IGNORE_ENVS="LS_COLORS LESSCLOSE LESSOPEN"
  ENV_CMD="env"
  for e in $IGNORE_ENVS;do
      ENV_CMD="$ENV_CMD -u $e"
  done;
  $ENV_CMD > $WP_ROOT/.env
}

function install_admin()
{
  WP="wp --allow-root"
  pushd $WP_ROOT &> /dev/null
  if [[ -n ${WP_ADMIN_USER:-} ]]; then
    WP_ADMIN_PASS=${WP_ADMIN_PASS:-root}
  fi
  if $($WP core is-installed || false); then
      echo "WP is installed"
  else
    echo "wp is not installed. Trying to install it"
    $WP core install --url=$HTTP_HOST  \
                     --title="${WP_SITE_TITLE:-MyShoppress}"  \
                     --admin_user=$WP_ADMIN_USER \
                     --admin_user=$WP_ADMIN_USER \
                     --admin_email=$WP_ADMIN_USER@$HTTP_HOST
  fi;
  popd $WP_ROOT &> /dev/null
}

#check if we run wp-cli
#sanity check if composer has run in the root
if [[ -d $WP_ROOT/vendor ]]; then
    dump_env_file;
    #only install admin if we are running in service mode
    ${SERVICE_MODE:-false} && install_admin 1>&2 || true
fi

#to reload php-fpm and nginx type reload-services.

