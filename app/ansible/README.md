# Ansible WordPress Provisioning

We spin up and harden the server with the [general ansible playbooks](https://bitbucket.org/evermade/ansible-playbooks), and provision the server with app requirements here. This way applications can be maintained easier.

It will install and configure the following software:

* Nginx with HTTP/2 and [improved default configs](https://github.com/A5hleyRich/wordpress-nginx)
* PHP 7
* MariaDB
* WP-CLI withe Super Cache cli package

## Usage

This is safe to run at any time.

NOTE: Use sudo password `Production Evermade Sudo user v2` when required.

Before you run this make sure that you've configured your [.env](../env/.env). This playbook requires these variables to be set:

* PRODUCTION_URL
* PRODUCTION_SECONDARY_URL (you can leave this empty)
* PRODUCTION_MYSQL_DATABASE
* PRODUCTION_MYSQL_USER
* PRODUCTION_MYSQL_PASSWORD

1. First run `em ansible` to be booted into a Docker container containing the correct versions of Python and Ansible.
2. Run `ansible-playbook provision.yml --ask-sudo-pass`

## Contributors

* Paul Stewart