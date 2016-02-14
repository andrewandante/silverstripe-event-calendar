<?php
/**
 * Event Registration Controller
 *
 */
class AttendanceController extends Page_Controller {
  
  private static $allowed_actions = array(
    'attendanceform',
  );
  
  public function init() {
    parent::init();
  }
  
  public function attendanceform() {
    $form = AttendanceForm::create(
      $this,
      'attendanceform'
    );
    if (isset($_GET['complete'])) {
      $form->setDone();
    }
    return $form;
  }
  
  /**
  * AJAX Json Response handler
  *
  * @param array|null $retVars
  * @param boolean $success
  * @return \SS_HTTPResponse
  */
  public function handleJsonResponse($success = false, $retVars = null) {
    $result = array();
    if ($success) {
      $result = array(
        'success' => $success
      );
    }
    if ($retVars) {
      $result = array_merge($retVars, $result);
    }
    $response = new SS_HTTPResponse(json_encode($result));
    $response->addHeader('Content-Type', 'application/json');
    return $response;
  }
}