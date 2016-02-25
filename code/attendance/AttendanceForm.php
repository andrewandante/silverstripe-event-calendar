<?php
/**
* Event Attendance Form
**
*/
class AttendanceForm extends Form {
  /**
   * Contructor
   * @param type $controller
   * @param type $name
   */
  public function __construct($controller, $name) {
    //Fields
    $fields = singleton('Attendance')->getFrontEndFields();
    //Actions
    $actions = FieldList::create(
      FormAction::create("doRegister")->setTitle("Register")
    );
    $this->addExtraClass('AttendanceForm');
    $this->addExtraClass($name);
    parent::__construct($controller, $name, $fields, $actions);
  }
  
  public function setDone() {
    $this->setFields(
      FieldList::create(
        LiteralField::create(
          'CompleteMsg',
          "Thanks for letting us know!"
        )
      )
    );
    $this->setActions(FieldList::create());
  }
  /**
   * Register action
   * @param type $data
   * @param type $form
   * @return \SS_HTTPResponse
   */
  public function doRegister($data, $form) {
    $att = Attendance::get()->filter(array(
      'MemberID' => $data['MemberID'],
      'MatchID' => $data['MatchID']
    ));
    if ($att->exists()) {
      $r = $att->sort('LastEdited', 'DESC')->First();
    } else {
      $r = new Attendance();
    }
    $form->saveInto($r);
    $r->write();
    // $from = Email::getAdminEmail();
    // $to = $r->Email;
    // $bcc = $EventDetails->RSVPEmail;
    // $subject = "Event Registration - ".$EventDetails->Title." - ".date("d/m/Y H:ia");
    // $body = "";
    // $email = new Email($from, $to, $subject, $body, null, null, $bcc);
    // $email->setTemplate('EventRegistration');
    // $email->send();
    return Controller::curr()->redirectBack();
  }
  
  public function setFormField($name, $value) {
    $fields = $this->Fields();
    foreach ($fields as $field) {
      //Debug::dump($field->Name);
      if ($field->Name == $name) {
        $field->setValue($value);
      }
    }
  }
}