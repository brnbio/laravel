# -*- mode: ruby -*-
# vi: set ft=ruby :

PHP_VERSION = "7.3"

Vagrant.configure(2) do |config|

    config.vm.define "web" do |web|

        web.vm.box = "laravel/homestead"
        web.vm.synced_folder "./", "/var/www/html"
        web.vm.provision :shell, path: "vagrant/web.sh", args: PHP_VERSION
        web.vm.network "private_network", ip: "192.168.30.17"

    end

end
