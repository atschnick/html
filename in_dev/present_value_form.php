<!DOCTYPE html>
<?php
	include "head.php";
	include "navbar.php";
?>
<body>
<br><br>
<center>
	<h1>Investment Planning</h1>
	<br>
	<form method=post action=present_value_result.php>
		<table border=0>
			<tr>
				<td>What is your investing goal?<br>
				(No dollar signs or commas)</td>
				<td>$<input type=text name=fv></td>
			</tr>
			<tr>
				<td>Over how many years?</td>
				<td><select type=text name=no_of_periods>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
				</select></td>
			</tr>
			<tr>
				<td>At what interest rate</td>
				<td><select type=text name=interest_rate>
					<option value="0.01">1.0%</option>
					<option value="0.015">1.5%</option>
					<option value="0.02">2.0%</option>
					<option value="0.025">2.5%</option>
					<option value="0.03">3.0%</option>
					<option value="0.035">3.5%</option>
					<option value="0.04">4.0%</option>
					<option value="0.045">4.5%</option>
					<option value="0.05">5.0%</option>
					<option value="0.055">5.5%</option>
					<option value="0.06">6.0%</option>
					<option value="0.065">6.5%</option>
					<option value="0.07">7.0%</option>
					<option value="0.075">7.5%</option>
					<option value="0.08">8.0%</option>
					<option value="0.085">8.5%</option>
					<option value="0.09">9.0%</option>
					<option value="0.095">9.5%</option>
					<option value="0.1">10.0%</option>
					<option value="0.105">10.5%</option>
					<option value="0.11">11.0%</option>
					<option value="0.115">11.5%</option>
					<option value="0.12">12.0%</option>
					<option value="0.125">12.5%</option>
					<option value="0.13">13.0%</option>
					<option value="0.135">13.5%</option>
					<option value="0.14">14.0%</option>
					<option value="0.145">14.5%</option>
					<option value="0.15">15.0%</option>
					<option value="0.155">15.5%</option>
					<option value="0.16">16.0%</option>
					<option value="0.165">16.5%</option>
					<option value="0.17">17.0%</option>
					<option value="0.175">17.5%</option>
					<option value="0.18">18.0%</option>
					<option value="0.185">18.5%</option>
					<option value="0.19">19.0%</option>
					<option value="0.195">19.5%</option>
					<option value="0.2">20.0%</option>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Submit></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>
