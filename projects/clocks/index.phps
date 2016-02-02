<?php
  
  echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
          <head>
            <title>English Long Case Clock Dating</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta name="description" content="English long case clock dating. Accurately date the age of your long case clock face and mechanism." />
	    <meta name="keywords" content="long, case, clock, dating, antique, clock" />
          </head>
          <body style="margin: 0px; padding: 0px; font-family: Arial;">';
  
  $features = array(    
                        array('square dials', 1680, 1820), // 0 - Start dial features
                        array('arched dials', 1730, 1860),
                        array('round dials', 1790, 1830),
                        array('dotted minutes', 1775, 1805),
                        array('double minute band', 1680, 1775),
                        array('roman hours I,II,III', 1680, 1860),
                        array('arabic hours 1,2,3', 1800, 1815),
                        array('minutes numbered 5,10,15', 1680, 1800),
                        array('minutes numbered 15,30,45,60', 1810, 1830),
                        array('minutes not numbered', 1820, 1860),
                        array('half-hour markers', 1680, 1740),
                        array('inner quarters marked', 1680, 1740),
                        array('half quarters marked', 1690, 1720),
                        array('tidal dials', 1760, 1820), // TODO: Dotted
                        array('rocking figure', 1750, 1840), // 14 - End dial features
                        array('10 inch 8 day', 1680, 1710), // 15 - Start dial sizes
                        array('10 inch 30 hour', 1680, 1760),
                        array('11 inch 8 day', 1690, 1730),
                        array('11 inch 30 hour', 1700, 1790),
                        array('12 inch 8 day', 1700, 1810),
                        array('12 inch 30 hour', 1720, 1830),
                        array('13 inch 8 day', 1770, 1825),
                        array('13 inch 30 hour', 1790, 1830),
                        array('14 inch 8 day', 1790, 1860),
                        array('14 inch 30 hour', 1790, 1840),
                        array('15 inch 8 day or 30 hour', 1810, 1860), // TODO: Dotted - 25 - End dial sizes
                        array('single hand', 1680, 1760), // 26 - Start hand styles
                        array('non-matching steel', 1680, 1785),
                        array('matching steel', 1790, 1815),
                        array('matching brass', 1820, 1860),
                        array('centre seconds', 1760, 1820), // TODO: Dotted - 30 - End hand styles
                        array('none', 1680, 1860), // 31 - Start calenders
                        array('circular box', 1680, 1720),
                        array('square box', 1680, 1790),
                        array('curved mouth', 1750, 1830),
                        array('in arch', 1720, 1750),
                        array('hand (pointer)', 1760, 1860),
                        array('long hand from centre', 1770, 1790),
                        array('named months', 1710, 1740), // 38 - End calenders
                        array('circular penny moon (square dial)', 1740, 1770), // 39 - Start moon dials
                        array('penny moon in arch', 1710, 1750),
                        array('half circle moon below XII', 1750, 1780),
                        array('rolling moon (silvered)', 1750, 1780 ),
                        array('rolling moon (painted)', 1750, 1835),
                        array('ball moon in arch', 1730, 1775), // TODO: Dotted
                        array('none', 1680, 1860), // 45 - End moon dials
                        array('brass', 1680, 1805), // 46 - Start dial type
                        array('white', 1780, 1860), // 47 - End dial type
                        );

  $featureGroups = array(array('Dial Features', 0, 14),
                         array('Dial Sizes', 15, 25),
                         array('Hand Styles', 26, 30),
                         array('Calendars', 31, 38),
                         array('Moon Dials', 39, 45),
                         array('Dial Type', 46, 47),
                         );
  
  echo '<div style="background-color: #000000; text-align: left; font-weight: bold; font-size: 18px; color: #ffffff; vertical-align: middle; padding-top: 30px; padding-bottom: 30px; padding-left: 20px; margin-bottom: 20px;">English Long Case Clock Dating</div>';
  
  
  echo '<div style="float: left;"><img src="clock.jpg" alt="Clock Image" /></div>';
  echo '<div style="float: right;"><img src="clock.jpg" alt="Clock Image" /></div>';
  
  
  if(isset($_POST['submit'])) {
    
    // TODO: Determine number of groups

    $selectedFeatureIds[] = intval($_POST['group-0']);
    $selectedFeatureIds[] = intval($_POST['group-1']);
    $selectedFeatureIds[] = intval($_POST['group-2']);
    $selectedFeatureIds[] = intval($_POST['group-3']);
    $selectedFeatureIds[] = intval($_POST['group-4']);
    $selectedFeatureIds[] = intval($_POST['group-5']);
    
    foreach($selectedFeatureIds as $featureId) {
      $selectedFeatures[] = $features[$featureId];
    }

  }
  
  
  echo '<center>
          <form action="./" method="POST">';
  
  echo '<table>';
  
  /* Print the selection options */
  foreach($featureGroups as $groupId => $featureGroup) {
  
    $groupName = $featureGroup[0];
    $groupFirstFeature = $featureGroup[1];
    $groupLastFeature = $featureGroup[2];
    
    echo '<tr>
            <td style="text-align: right;">'.$groupName.': </td>';
            
    echo '<td><select name="group-'.$groupId.'" />';
    
    for($featureId = $groupFirstFeature; $featureId <= $groupLastFeature; $featureId++) {
      if(isset($selectedFeatureIds) && in_array($featureId, $selectedFeatureIds)) {
        echo '<option value="'.$featureId.'" selected>'.ucwords($features[$featureId][0]).'</option>';
      } else {
        echo '<option value="'.$featureId.'">'.ucwords($features[$featureId][0]).'</option>';
      }
    }
    
    echo '</select>
        </td>
      </tr>';
  
  }
  
  echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
  
  echo '<tr><td colspan="2" style="text-align: center;"><input type="submit" name="submit" value="Submit" style="width: 100%;"/></td></tr>';
  
  echo '</table>';
  
  echo '</form>';
  
  if(isset($_POST['submit'])) {
    
    $startYear = getHighestStartYear();
    $endYear = getLowestEndYear();
    echo '<br />';
    if($startYear > $endYear || !($startYear > 0) || !($endYear > 0)) {
      echo 'You\'ve been tango\'d!';
    } else {
      echo 'Dated from '.$startYear.' to '.$endYear;
    }
    
    
  }
  
  echo '</center>';
  
  echo '<div style="position: absolute; bottom: 0px; right: 0px; left: 0px; background-color: #000000; text-align: center; font-weight: bold; font-size: 14px; color: #ffffff; vertical-align: middle; height: 40px;">
          <div style="float: left; padding-top: 10px; padding-bottom: 10px; padding-left: 10px;">
            <img align="middle" src="http://www.e-zeeinternet.com/count.php?page=609128&style=default&nbdigits=4&reloads=1" alt="Hit Counter" style="height: 20px;"/>
          </div>
          <div style="padding-top: 10px; padding-bottom: 10px; position: absolute; left: 0px; right: 0px;">
            made by matthew dooler
          </div>
        </div>';
  
  echo '</body>
      </html>';

  
  
  function getHighestStartYear() {
    global $selectedFeatures;
    $features = $selectedFeatures;

    $highestYearFound = $features[0][1];
    foreach($features as $feature) {
      $startYear = $feature[1];
      
      if($startYear > $highestYearFound) {
        $highestYearFound = $startYear;
      }
    }
    return $highestYearFound;
    
  }
  
  function getLowestEndYear() {
    global $selectedFeatures;
    $features = $selectedFeatures;

    $lowestYearFound = $features[0][2];
    
    //echo '!'.$lowestYearFound;
    
    foreach($features as $feature) {
      $endYear = $feature[2];
      if($endYear < $lowestYearFound) {
        $lowestYearFound = $endYear;
      }
    }
    return $lowestYearFound;
  }
  


  
?>
