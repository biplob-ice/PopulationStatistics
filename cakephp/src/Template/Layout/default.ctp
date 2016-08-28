<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('List Population'), ['controller' => 'Populations', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Import Populations'), ['controller' => 'Populations', 'action' => 'import']) ?></li>
        </ul>
    </nav>    
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        // default view data load
        // fetchData();

        // ajax filtering
        $('#ajaxForm').on('change keyup', function(e) {
            e.preventDefault();
            fetchData($(this).serialize());
        });
    });

    function fetchData(formData) {
        $.ajax({ 
            type: "POST",
            url: "<?php echo $this->Url->build(['action'=>'index']);?>",
            data: formData,
            dataType: "html",
            success: function(data){
                $(".ajaxData").html(data);
                console.log(data);
            }
        });        
    }        
    </script>    
</body>
</html>
