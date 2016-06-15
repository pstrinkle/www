<tr>
<td valign="top">
<p class="bodygrey"><b>Last Name: <font color="#000000"><%=rs.Fields("LName").Value %></font><br>
First Name: <font color="#000000"><%=rs.Fields("FName").Value %></font></b><br>
<b>Position:</b> <font color="#000000"><%=rs.Fields("Rank").Value %></font><br>
<b>AIM SN:</b> <font color="#DE7777"><%=rs.Fields("AIM_SN").Value %></font><br>
<b>Email:</b> <a href="mailto:<%=rs.Fields("Email").Value %>" class="org"><%=rs.Fields("Email").Value %></a><br>
<b>Team:</b> <font color="#000000"><%=rs.Fields("Team").Value %></font><br>
<b>Quote:</b> <font color="#DE7777"><%=rs.Fields("Quote").Value %></font><br>
<b>Bio:</b> <font color="#DE7777"><%=rs.Fields("Bio").Value %></font><% If rs.Fields("AIM_SN").Value <> "" Then %><br>
<b>AIM STATUS:</b><IMG SRC="http://big.oscar.aol.com/<%=rs.Fields("AIM_SN").Value %>?on_url=http://1shoe.net/online.gif&off_url=http://1shoe.net/offline.gif"><font color="#000000">(Only works under certain conditions)</font><% End IF %>
</p>
</td>
<td width="131" valign="top">
<p align="center"><% If rs.Fields("MugShot").Value <> "" Then %><img src="_images/_sac/<%=rs.Fields("MugShot").Value %>" alt="<%=rs.Fields("FName").Value %>&nbsp;<%=rs.Fields("LName").Value %>"><% Else %><img src="_images/_sac/nophoto.jpg" alt="Without Photo"><% End If %></p>
</td>
</tr>
<tr>
<td colspan="2"><a href="#top">_top</a><br>
<hr>
</td></tr>
