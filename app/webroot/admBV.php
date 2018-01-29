<?php

/**
 * Class AdminBV
 */
class AdminBV
{
    
    protected $instanceName = '';

    protected $instanceDirectory = '';

    /**
     * @var StepManager
     */
    protected $step = null;

    public function __construct($instanceName, $instanceDirectory) {
        $this->instanceName = $instanceName;
        $this->instanceDirectory = $instanceDirectory;
        $this->step = new StepManager();
    }

    protected function cmd($cmd) {
        $output = array();
        $return_var = 0;
        exec($cmd, $output, $return_var);
        print_r($output);
    }

    public function backupFiles() {
        $this->step->start('Backup des fichiers');
        $archive = '/home/wwwrun/backup_' . $this->instanceName . '_' . date('Y-m-d_H-i-s') . '.tar.gz';
        $cmd = 'tar czf ' . $archive . ' ' . $this->instanceDirectory.' 2>&1';
        $this->cmd($cmd);
        $this->step->end();
    }

    public function restoreFiles() {
        $this->step->start('restauration des fichiers');
        $archivePatern = '/home/wwwrun/backup_' . $this->instanceName . '_*.tar.gz';
        $archive = $this->getLastFile($archivePatern);
        $cmd = 'tar xzf /home/wwwrun/' . $archive.' 2>&1';
        $this->cmd($cmd);
        $this->step->end();
    }

    public function backupDB() {
        $this->step->start('Backup de la DB');
        $archive = '/home/wwwrun/backup_' . $this->instanceName . '_' . date('Y-m-d_H-i-s') . '.sql.gz';
        $cmd = "mysqldump -uroot '-pebba4#$$#' " . $this->instanceName . " | gzip > " . $archive;
        $this->cmd($cmd);
        $this->step->end();
    }

    public function restoreDB() {
        $this->step->start('restauration de la DB');
        $archivePatern = '/home/wwwrun/backup_' . $this->instanceName . '_*.sql';
        $archive = $this->getLastFile($archivePatern);
        $cmd = "cat ".$archive." | gunzip | mysql -uroot '-pebba4#$$#' " . $this->instanceName.' 2>&1';
        $this->cmd($cmd);
        $this->step->end();
    }

    public function updateDB() {
        $this->step->start('Mise à jour de la DB');
        $cmd = "mysql -uroot '-pebba4#$$#' " . $this->instanceName . " < DB/update.sql 2>&1";
        $this->cmd($cmd);
        $this->step->end();
    }

    public function updateFiles() {
        $this->step->start('Mise à jour des fichiers');
        $cmd = "svn up 2>&1";
        $this->cmd($cmd);
        $this->step->end();
    }

    public function changeRight() {
        $this->step->start('Affectation des droits');
        $timeStart = time();
        $this->step->update('En cour 1/3 '.(time()-$timeStart).'s');
        $this->cmd('find . -type d -exec chmod 755 {} \; 2>&1');
        $this->step->update('En cour 2/3 '.(time()-$timeStart).'s');
        $this->cmd('find . -type f -exec chmod 644 {} \; 2>&1');
        $this->step->update('En cour 3/3 '.(time()-$timeStart).'s');
        $this->cmd('chmod u+x ./app/Console/cake 2>&1');
        $this->step->end();
    }

    public function clearCache() {
        $this->step->start('Nettoyage du cache');
        $cmd = 'rm ./app/tmp/cache/models/* ; rm ./app/tmp/cache/persistent/* ; rm ./app/tmp/cache/ views/* 2>&1';
        $this->cmd($cmd);
        $this->step->end();
    }

    protected function getLastFile($filePatern) {
        $files = array();
        $this->instanceDirectory = new GlobIterator ($filePatern);
        foreach ($this->instanceDirectory as $fileinfo) {
            $files[] = $fileinfo->getFilename();
        }
        natcasesort($files);
        $files = array_reverse($files);
        return $files[0];
    }


    public function miseEnProd() {
        set_time_limit(0);
        $this->step->init(array(
            'Backup des fichiers',
            'Backup de la DB',
            'Mise à jour des fichiers',
            'Mise à jour de la DB',
            'Affectation des droits',
            'Nettoyage du cache',
        ));
        $this->backupFiles();
        $this->backupDB();
        $this->updateFiles();
        $this->updateDB();
        $this->changeRight();
        $this->clearCache();
        echo 'OK';
    }

    public function rollback() {
        set_time_limit(0);
        $this->step->init(array(
            'restauration de la DB',
            'restauration des fichiers',
            'Affectation des droits',
            'Nettoyage du cache',
        ));
        $this->restoreDB();
        $this->restoreFiles();
        $this->changeRight();
        $this->clearCache();echo 'OK';
    }

    public function test() {
        set_time_limit(0);
        $this->step->init(array(
            'test step1',
            'test step2'
        ));
        $this->step->start('test step1');
        sleep(6);
        $this->step->update('30%');
        sleep(6);
        $this->step->end();
        $this->step->start('test step2');
        sleep(4);
        $this->step->update('50%');
        sleep(6);
        $this->step->end();
        echo 'OK';
    }

}

class StepManager {

    protected $steps = array();
    protected $currentStep ='';
    protected $stepTime = 0;

    const NOT_STARTED = '...';
    const IN_PROGESS = 'En cours';
    const FINISHED = 'Terminée';

    public function init(array $steps){
        foreach ($steps as $step) {
            $this->steps[$step] = self::IN_PROGESS;
        }
        file_put_contents(__DIR__.'/AdminBV_task.json', json_encode($this->steps));
    }

    public function update($status){
        $this->steps[$this->currentStep] = $status;
        file_put_contents(__DIR__.'/AdminBV_task.json', json_encode($this->steps));
    }

    public function start($currentStep){
        $this->currentStep = $currentStep;
        $this->stepTime = time();
        $this->update(self::IN_PROGESS);
    }

    public function end(){
        $this->update(self::FINISHED.' '.(time()-$this->stepTime).'s');
    }
}

function getDBList(PDO $DB)
{
    $stmt = $DB->prepare("SHOW DATABASES;");
    if (!$stmt->execute()) {
        return array();
    }
    $rows = $stmt->fetchAll();
    $lst = array();
    foreach ($rows as $rs) {
        $lst[] = $rs['Database'];
    }
    return $lst;
}

if (($_SERVER['PHP_AUTH_USER'] != 'admin') || ($_SERVER['PHP_AUTH_PW'] != '42pointsGodwin')) {
    header('WWW-Authenticate: Basic realm="administration du BV"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Mot de passe requis';
    exit;
}

$instanceDirectory = dirname(dirname(__DIR__));
$instance = basename($instanceDirectory);

$DB = new PDO('mysql:host=localhost;', 'root', 'ebba4#$$#');

$admBv = new AdminBV($instance, $instanceDirectory);
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'mep') {
        $admBv->miseEnProd();
        exit();
    }
    if ($_POST['action'] == 'rollback') {
        $admBv->rollback();
        exit();
    }
    if ($_POST['action'] == 'test') {
        $admBv->test();
        exit();
    }

}
?>
<html>
<head>
    <title>MEP</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
    <script type="text/javascript" src="/bv2_preprod/js/jquery.migrate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script>
        //Pagination
        $(document).on('click', '#mep, #rollback, #test', function (e) {
            e.preventDefault();
            var action = this.name;
            $.ajax({
                async: true,
                type: 'post',
                url: 'admBV.php',
                data: {"action":action},
                success: function (request, json) {
                    $('#status').html("Ok : " + request.responseText);
                },
                complete: function (request, json) {
                    $('#status').html(request.responseText);
                },
                error: function (request, json) {
                    $('#status').html("Oops!");
                }
            });
        });
        function updateStatus() {
            $.ajax({
                async: true,
                type: 'get',
                url: 'AdminBV_task.json',
                complete: function (request, json) {
                    var steps = $.parseJSON(request.responseText);
                    var html = '<ul>';
                    for (key in steps) {
                        html += '<li>' + key + ' : ' + steps[key] + '</li>';
                    }
                    html += '</ul>';
                    $('#steps').html(html);
                }
            });
        }
        setInterval(updateStatus, 2000);
    </script>
</head>
<body>
<h1>MEP</h1>
    <input type="submit" name="test" id="test" value="test" />
    <input type="submit" name="mep" id="mep" value="Mise en prod" />
    <input type="submit" name="rollback" id="rollback" value="Rollback" />
<div id="steps" style="border-style: solid;border-width: 2px;">
    Etapes
</div>
<div id="status" style="border-style: solid;border-width: 2px;">
    statut
</div>
</body>
</html>
