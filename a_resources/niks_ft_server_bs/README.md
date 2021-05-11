<h1>Codam Coding College Project: ft_server</h1>
<h3>HOW TO USE DOCKERFILES.</h3>
<p>1. BUILD THE IMAGE. DEFAULT:</p>
<p><code>docker build -t ft_server .</code></p>
<p>CHANGABLE VARIABLES WITH <code>--build-arg</code> argument:</p>
<table>
  <tr>
    <td>- admin username (admin_user)</td>
  </tr>
  <tr>
    <td>- password (admin_pw)</td>
  </tr>
  <tr>
    <td>- email (admin_email)</td>
  </tr>
  <tr>
    <td>- autoindex on or off (autoindex)</td>
  </tr>
</table>
ADD:<br>
<p><code>--build-arg [variable]=[your_input]</code></p>
<p><b>EXAMPLE:</b></p>
<p><code>docker build -t ft_server . --build-arg admin_user=nhariman --build-arg admin_pw=codam --build-arg admin_email=email@email.com --build-arg autoindex=on</code><br>
(feel free to edit and copy the above to your liking while testing)</p>
<p>2. RUN THE IMAGE.<br>
<code>docker run -it -p 80:80 -p 443:443 ft_server</code></p>
<p>3. CHECK IF IT WORKS, GO TO:<br>
<code>127.0.0.1</code> OR <code>localhost</code></p>
<p>FOR WORDPRESS: <br><code>localhost/wordpress</code></p>
<p>FOR PHPMYADMIN: <br><code>localhost/phpmyadmin</code></p>
<p>TO CHECK AUTOINDEX: <br><code>localhost/wordpress/wp-includes</code></p>
<p>OPTIONAL: REBUILD WITH NO-CACHE<br>
<code>docker docker build -t ft_server . --no-cache </code></p>
<p>TO CHECK IF ONLY ONE CONTAINER IS RUNNING:<br>
<code>docker ps</code></p>
