<%
'Reset Sever Objects 
	rs.Close             ' close the RecordSet
	rs2.Close        
	con.Close            ' close the Connection
        Set rs = Nothing     ' reset the variable rs (to null)
	Set rs2 = Nothing
	Set Con = Nothing    ' reset the variable Con (to null)



'con.Close 
'Set rs = Nothing
%>