<?php

/* ==============================================================
 *
 * bunjs
 *
 * ==============================================================
 *
 * @copyright  2014 Richard Lobb, University of Canterbury
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace Jobe;

class BunTask extends LanguageTask
{
    public function __construct($filename, $input, $params)
    {
        parent::__construct($filename, $input, $params);
        $this->default_params['interpreterargs'] = array();
    }

    public static function getVersionCommand()
    {
        return array("/usr/local/bin/bun --version", '/([0-9._]*)/');
    }

    public function compile()
    {
        $this->executableFileName = $this->sourceFileName;
        if (strpos('.js', $this->executableFileName) != strlen($this->executableFileName) - 3) {
            $this->executableFileName .= '.js';
        } else if (strpos('.ts', $this->executableFileName) != strlen($this->executableFileName) - 3) {
            $this->executableFileName .= '.ts';
        }
        if (!copy($this->sourceFileName, $this->executableFileName)) {
            throw new exception("Bun_Task: couldn't copy source file");
        }
    }


    // A default name forjs programs
    public function defaultFileName($sourcecode)
    {
        return 'prog.js';
    }

    public function getExecutablePath()
    {
         return '/usr/local/bin/bun';
    }


    public function getTargetFile()
    {
        return $this->sourceFileName;
    }
}
