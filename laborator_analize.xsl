<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
	  <head>
		<link rel="stylesheet" href="./dashboard.css"></link>
	
	</head>
  <body>
		<div class="topnav">
			<a href="./dashboard.php">Acasa</a>
			<a href="./incarcare_XML.php">Incarcare XML</a>
			<a href="./incarcare_Json.php">Incarcare JSON</a>
			<a href="./vizualizare_tabel.php">Vizualizare tabele</a>
		</div>
	   <caption><font size="10">Medici</font></caption>
	   <table border="1">
	   <tr bgcolor="#4682b4" border = "2">
			<th>Nume</th>
			<th>Prenume</th>
			<th>Varsta</th>
			<th>Vechime</th>
			<th>Specializare</th>
       </tr>
	   <xsl:for-each select="laborator_medical/medici/medic">
	    <tr>
			 <td><xsl:value-of select="nume_medic"/></td>
			 <td><xsl:value-of select="prenume_medic"/></td>
			 <td><xsl:value-of select="varsta_medic"/></td>
			 <td><xsl:value-of select="vechime"/></td>
			 <td>
				<xsl:for-each select="specializare">
				 	<xsl:value-of select="."/>
					 <br></br>
				</xsl:for-each>
			</td>
       </tr>
	   </xsl:for-each>
     </table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>
