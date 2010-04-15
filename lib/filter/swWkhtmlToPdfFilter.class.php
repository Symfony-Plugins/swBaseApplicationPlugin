<?php


class swWkhtmlToPdfFilter extends sfFilter
{
  /**
   * Executes this filter.
   *
   * @param sfFilterChain $filterChain A sfFilterChain instance
   */
  public function execute($filterChain)
  {
    // transform the PDF version of the content into PDF
    $sf_format = $this->context->getRequest()->getParameter('force_format', $this->context->getRequest()->getParameter('sf_format'));
    
    if($sf_format == 'pdf')
    {
      // you can use this event to setup specific asset for the pdf output
      $this->context->getEventDispatcher()->notify(new sfEvent($this, 'wkhtml.initialize'));
    }
    
    // execute the filter chain
    $filterChain->execute();
    
    if($sf_format == 'pdf')
    {
      
      $driver = new swWkhtmlPdf(array(
        'host' => $this->context->getRequest()->getHost(),
        'is_secure' => $this->context->getRequest()->isSecure()
      ));
      
      $driver->setContent($this->context->getResponse()->getContent());
      $pdf_file = $driver->convert();
      
      $this->context->getResponse()->setContentType('application/pdf');
      $this->context->getResponse()->setContent(file_get_contents($pdf_file));
    }
  }
}