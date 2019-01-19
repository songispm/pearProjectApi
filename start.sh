#!/bin/bash
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_register.php start&
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_gateway.php start&
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_businessworker.php start;
