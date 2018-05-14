# -*- mode: ruby -*-
# vi: set ft=ruby :
#
# WPDistillery Vagrantfile using Scotch Box
#
# File Version: 1.0

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box-pro"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.hostname = "launchpad.test"

    config.ssh.username = "vagrant"
    config.ssh.password = "vagrant"

    # Windows Support
    if Vagrant::Util::Platform.windows?
      config.vm.provision "shell",
      inline: "echo \"Converting Files for Windows\" && sudo apt-get install -y dos2unix && cd /var/www/ && dos2unix wpdistillery/config.yml && dos2unix wpdistillery/provision.sh && dos2unix wpdistillery/wpdistillery.sh",
      run: "always", privileged: false
    end

    # Run Provisioning – executed within the first `vagrant up` and every `vagrant provision`
    config.vm.provision "shell", path: "wpdistillery/provision.sh"

    # OPTIONAL - Update WordPress and all Plugins on vagrant up – executed within every `vagrant up`
    config.vm.provision "shell", inline: "echo \"== Update WordPress & Plugins ==\" && cd /var/www/public && wp core update && wp plugin update --all", run: "always", privileged: false

    # OPTIONAL - Enable NFS. Make sure to remove line 13 (See https://stefanwrobel.com/how-to-make-vagrant-performance-not-suck)
    config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    config.vm.provider "virtualbox" do |v|
      host = RbConfig::CONFIG['host_os']

      # Give VM 1/4 system memory
      if host =~ /darwin/
        # sysctl returns Bytes and we need to convert to MB
        mem = `sysctl -n hw.memsize`.to_i / 1024
      elsif host =~ /linux/
        # meminfo shows KB and we need to convert to MB
        mem = `grep 'MemTotal' /proc/meminfo | sed -e 's/MemTotal://' -e 's/ kB//'`.to_i
      elsif host =~ /mswin|mingw|cygwin/
        # Windows code via https://github.com/rdsubhas/vagrant-faster
        mem = `wmic computersystem Get TotalPhysicalMemory`.split[1].to_i / 1024
      end

      mem = mem / 1024 / 4
      v.customize ["modifyvm", :id, "--memory", mem]
    end
end
