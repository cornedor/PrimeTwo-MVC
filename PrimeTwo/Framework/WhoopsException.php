<?php
/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/7/15
 * Time: 6:44 PM
 */

namespace PrimeTwo\Framework;

use Exception as BaseException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsException extends BaseException {

    public function __construct(array $array = null, string $label = null) {
        $run = new Run();
        $handler = new PrettyPageHandler();
        $run->pushHandler($handler);

        // tag frames inside a function with their function name. TODO: verdere mogelijkheden uitwerken dit is van de whoops example gejat :P
        $run->pushHandler(function ($exception, $inspector, $run) {
            $inspector->getFrames()->map(function ($frame) {
                if ($function = $frame->getFunction()) {
                    $frame->addComment("This frame is within function '$function'", 'PrimeTwo-MVC');
                }
                return $frame;
            });
        });

        if(!empty($array)) {
            $label = (empty($label)?"Array":$label);
            $handler->addDataTable($label, $array);
        }

        $run->register();
    }

}