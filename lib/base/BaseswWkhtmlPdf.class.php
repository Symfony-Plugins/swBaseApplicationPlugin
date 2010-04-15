<?php

class BaseswWkhtmlPdf
{
  protected 
    $content = null,
    $host    = null,
    $is_secure = false,
    $options = array();
  
  
  public function __construct($options = array())
  {
    $this->options = $options;
    
    $this->host      = isset($options['host']) ? $options['host'] : '';
    $this->is_secure = isset($options['is_secure']) ? $options['is_secure'] : false;
  }
  
  public function setContent($content)
  {
    $this->content = $content;
  }
  
  public function convert()
  {
    $content = $this->appendHostInformation($this->content);

    $basename = tempnam(sys_get_temp_dir(), 'sw_wkhtml_');
    $input  = $basename.'.html';
    $output = $basename.'.pdf';
    
    file_put_contents($input, $content);
    
    $config = sfConfig::get('app_swToolbox_wkhtml', array('command' => 'wkhtmltopdf'));

    $cmd = sprintf('%s %s %s',
      $config['command'],
      $input,
      $output
    );
    
    $pipes = array();
    $proc = proc_open($cmd, array(
      0 => array('pipe','r'),
      1 => array('pipe','w'),
      2 => array('pipe','w')
    ), $pipes);

    fwrite($pipes[0], $input);
    fclose($pipes[0]);
    
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    
    $rtn = proc_close($proc);
    
    return $output;
  }
  
  public function appendHostInformation($content)
  {
    $pattern = '/(href|src)=(\'|")([^"\']+)(\'|")/';
    
    $content = preg_replace_callback($pattern, array($this, 'callbackAppendHostInformation'), $content);
    
    return $content;
  }
  
  public function callbackAppendHostInformation($matches)
  {
    // nothing to do
    if(substr($matches[3], 0, 4) == 'http')
    {
      
      return;
    }
    
    $uri      = substr($matches[3], 0, 1) == '/' ? substr($matches[3], 1) : $matches[3];
    $protocol = $this->is_secure ? 'https' : 'http';
    
    return sprintf('%s=%s%s%s', 
      $matches[1],
      $matches[2],
      $protocol.'://'.$this->host.'/'.$uri,
      $matches[4]
    );
  }
}