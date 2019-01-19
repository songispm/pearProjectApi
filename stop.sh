#!/bin/bash
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_register.php stop&
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_gateway.php stop&
php /home/handong/pearProjectApi/application/common/Plugins/GateWayWorker/start_businessworker.php stop;
