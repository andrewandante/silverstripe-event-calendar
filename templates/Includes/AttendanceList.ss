<% loop Attendances %>
  <% if Status == 'Playing' %>
    <h3 style="color: green">
  <% else_if Status == 'Absent' %>
    <h3 style="color: red">
  <% else %>
    <h3 style="color: gold">
  <% end_if %>
  $Member.FirstName
  <% if $Notes %>- $Notes<% end_if%>
  </h3>
<% end_loop %>