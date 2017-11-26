<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/18/2015
 * Time: 3:59 PM
 */

use Illuminate\Database\QueryException;

$e = $obj->exception;
?>

<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            body {
                font-family: "Verdana", sans-serif;
                font-size: 12px;
            }
            tr > td:first-child {
                font-weight:bold;
                text-align: right;
            }
            tr > td:nth-child(2) {
                background: aliceblue;
                border: solid 1px aliceblue;
            }
            tr > td:nth-child(2) em {
                background-color: #ffd5d5;
            }
            hr {
                height: 0px;
                display:block;
                border-top: solid 1px black;
            }
            hr.dotted {
                border-top: dotted 1px #999;
            }
            td, pre {
                margin: 0;
                padding: 0;
                vertical-align: top;
            }
            table {
                margin-top: -15px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <h2><?php echo $obj->title; ?>:</h2>
        <h3><?php echo $obj->message; ?></h3>
        <u>File:</u> <?php echo $obj->file; ?>: <?php echo $obj->line; ?>
        <ul>
            <?php
                if($e instanceof QueryException){
                    /** @var QueryException $e */
                    echo '<li>';
                    echo '<label>Query Exception SQL: </label>';
                    echo $e->getSql();
                    echo '</li>';
                }?>

            <?php
            if($e instanceof PDOException){
                /** @var PDOException $e */
                echo '<li>';
                echo '<label>PDO Exception SQL:</label>';
                echo $e->getSql();
                echo '</li>';
            }
            ?>
        </ul>

    <hr class="dotted"/>
    <h3>Backtrace:</h3>
        <ol>
            <?php foreach($obj->backtrace_items as $item){ ?>
                <li><table><?php
                foreach(['file', 'line', 'function', 'class', 'type', 'args', 'source'] as $field){
                    echo '<tr>';
                    if(array_key_exists($field, $item)){
                        if(is_array($item[$field])){
                            echo '<td>' . $field . ': </td><td><pre>' . print_r($item[$field], true) . "</pre></td>";
                        } else {
                            echo '<td>' . $field . ': </td><td><pre>' . $item[$field] . "</pre></td>";
                        }
                    }
                    echo '</tr>';
                }
                ?></table>
                </li>
            <?php } ?>
        </ol>
    <hr />
    </body>
</html>
