<?php
 /* resolve streamtape
 * Copyright (c) 2019 vb6rocod
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * examples of usage :
 * $filelink = input file
 * $link --> video_link
 */

$filelink="https://streamtape.com/e/Jq2V9jmvyrT9Ja";
if (strpos($filelink,"streamtape.com") !== false) {
 $cookie=$base_cookie."streamtape.dat";
 $head=array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
 'Accept-Language: ro-RO,ro;q=0.8,en-US;q=0.6,en-GB;q=0.4,en;q=0.2',
 'Accept-Encoding: deflate',
 'Referer: https://serialeonline.io/episoade/magnum-p-i-sezonul-3-episodul-2/',
 'Connection: keep-alive',
 'Upgrade-Insecure-Requests: 1');
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $filelink);
 curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
 curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERAGENT, $ua);
 curl_setopt($ch, CURLOPT_HTTPHEADER,$head);
 curl_setopt($ch, CURLOPT_ENCODING, "");
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
 curl_setopt($ch, CURLOPT_TIMEOUT, 25);
 curl_setopt($ch, CURLINFO_HEADER_OUT, true);
 $h = curl_exec($ch);
 $info = curl_getinfo($ch);
 curl_close($ch);
 $h=str_replace("\\","",$h);
  if (preg_match('/(\/\/[\.\d\w\-\.\/\\\:\?\&\#\%\_\,]*(\.(srt|vtt)))/', $h, $s))
  $srt="https:".$s[1];

  if (preg_match("/\(\'\w+\'\)\.innerHTML\s*\=((\s*\(?[\'|\"]([^\'|\"]*)\)?[\'|\"]\s*\+\s*)+)\(?[\'|\"]([^\'|\"]+)[\'|\"]\)?\.substring\((\d+)\)/i",$h,$m)) {
   $rest=substr($m[4],$m[5]);
   $e="\$link=".str_replace("+",".",$m[1])."'".$rest."';";
   eval ($e);
   $link .= "&stream=1";
   if ($link[0]=="/") $link="https:".$link;
  }
}
echo $link;
?>
