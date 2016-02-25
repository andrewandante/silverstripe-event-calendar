<ul>
  <h3 style="font-style: italic">Latest Results:</h3>
  <% loop LatestResults %>
  <li class="vevent clearfix">
    <h3 class="summary"><a class="url" href="$Link">$Title</a></h3>
    $Result : Black Doris Rovers $BDRScore - $OppositionScore $Opposition
  </li>
  <% end_loop %>
  <h3 style="font-style: italic">Upcoming Events:</h3>
  <% loop Events %>
  <% if not Announcement %>
  <li class="vevent clearfix">
    <h3 class="summary"><a class="url" href="$Link">$Event.Title</a></h3>
    <p class="dates">$DateRange <% if AllDay %><% _t('Calendar.ALLDAY','All Day') %><% else %><% if StartTime %>$TimeRange<% end_if %><% end_if %></p>
    <% with Event %>$Content.LimitWordCount(60)<% end_with %> <a href="$Link"><% _t('Calendar.MORE','Register&hellip;') %></a>
  </li>
  <% end_if %>
  <% end_loop %>
</ul>
<% if MoreEvents %>
  <a href="$MoreLink" class="calendar-view-more"><% _t('Calendar.VIEWMOREEVENTS','View more events...') %></a>
<% end_if %>
