<% loop Attendances %>
  <% if Status == 'Playing' %>
    <h3 style="color: green">
  <% else_if Status == 'Absent' %>
    <h3 style="color: red">
  <% else_if Status == 'Other' %>
    <h3 style="color: gray">
  <% end_if %>
  <i class="fa fa-user fa-fw"></i>
  $Member.FirstName
  <% if $Notes %>- $Notes<% end_if%>
  </h3>
<% end_loop %>