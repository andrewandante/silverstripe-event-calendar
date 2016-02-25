<?php 

class Attendance extends DataObject {
  
  public static $singular_name = 'Attendance';
  public static $plural_name = 'Attendances';
  public static $default_sort = 'Status';
  
  public static $db = array(
    'Status' => "Enum('Playing,Absent,Other,Unknown', 'Unknown')",
    'Notes' => 'Text'
  );
  
  public static $has_one = array(
    'Match' => 'Match',
    'Member' => 'Member'
  );
  
  public static $summary_fields = array(
    'Member.FirstName' => 'First Name',
    'Member.Surname' => 'Last Name',
    'Status' => 'Attendance Status',
    'Notes' => 'Notes'
  );
  
  public function getFrontEndFields($param = null) {
    $fields = FieldList::create(
      HiddenField::create('MemberID', 'Member', Member::currentUserID()),
      DropdownField::create('Status', 'Status', singleton('Attendance')->dbObject('Status')->enumValues()),
      TextField::create('Notes'),
      HiddenField::create('MatchID')
    );
    $this->extend('updateFrontEndFields', $fields);
    return $fields;
  }
}