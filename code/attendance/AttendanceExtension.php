<?php
/**
 * Allowing events to have attendance
 *
 */
class AttendanceExtension extends DataExtension {

  public static $has_many = array(
    'Attendances' => 'Attendance'
  );
  
  public function updateCMSFields(FieldList $fields) {
    
    $registrations = new GridField('Attendances', 'Attendance',
        $this->owner->Attendances(),
        GridFieldConfig_RelationEditor::create()
    );
    
    $fields->addFieldsToTab('Root.Attendance', array(
      new HeaderField('Header5', 'Current Registrations', 2),
      $registrations
    ));
  }  
  
    /**
     * Getter for registration link
     */
    public function getAttendanceLink() {
        $detailStr = 'attendance/' . $this->owner->ID;
        $event = CalendarEvent::get()->First();
        return $event->Link() .  $detailStr;
    }
    public function AttendanceForm() {
        $c = new AttendanceController();
        $form = $c->attendanceform();
        if ($form) {
            $form->setFormField('CalendarEventID', $this->owner->ID);
            $form->setFormField('Member', Member::currentUser());
        }
        return $form;
    }
}