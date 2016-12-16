					<h2>Demo<?php echo ' '.$r.$s; ?>: Complex Table Enhancement</h2>
					<p>Giving a user multiple ways to order and reporder data enables them</p>
					<div id="demo">
						<form>
							<p><label for="game_id">Game</label>
								<select id="tournament_search_game_id" name="tournament_search[game_id]">
									<option value="1" selected="selected">Counter Strike Source</option>
									<option value="5">Counter Strike 1.6</option>
								</select></p>
							<p><label for="tournament_type">Structure</label>
								<select id="tournament_type" name="tournament_type">
									<option value="scheduled">Scheduled</option>
									<option value="sit_and_go" selected="selected">Sit and Go</option>
								</select></p>
							<p><label for="tournament_search_participant_size">Gamers per Team</label><!-- Participant -->
								<select id="tournament_search_participant_size" name="tournament_search[participant_size]">
									<option value="" selected="selected">All</option>
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
								</select></p>
						</form>
						<form action="/tournaments/search" class="edit_tournament_search" id="tournament_search" method="post">
							<div style="margin: 0pt; padding: 0pt; display: inline;">
								<input name="authenticity_token" value="xl1CLkKgb6QI7dVuJ+BdZNRTDR5ijuRLBZ6tiDhEBy0=" type="hidden">
							</div>
							<input id="tournament_type" name="tournament_type" value="sit_and_go" type="hidden">
							<input id="sort" name="sort" value="percentage_full_desc" type="hidden">
							<input id="tournament_search_participant_size" name="tournament_search[participant_size]" value="" type="hidden">
							<table class="tablesorter">
								<thead>
									<tr>
										<th>Name</th>
										<th><label for="tournament_search_win_limit">Rounds</label><!-- Max Rounds --></th>
										<th><label for="num_participants">Teams</label><!-- Participants --></th>
										<th><label for="tournament_search_level_id">Map</label></th>
										<th><label for="buy_in">Registration</label></th>
									</tr>
									<tr id="filters">
										<td class="jc">Filters</td>
										<td><select id="tournament_search_win_limit" name="tournament_search[win_limit]">
												<option value="">All</option>
												<option value="9">9</option>
												<option value="12">12</option>
												<option value="15">15</option>
											</select></td>
										<td><select id="num_participants" name="num_participants">
												<option value="">All</option>
												<option value="2:2">2</option>
												<option value="4:4">4</option>
												<option value="8:8">8</option>
												<option value="16:16">16</option>
											</select></td>
										<td><select id="tournament_search_level_id" name="tournament_search[level_id]">
												<option value="">All</option>
												<option value="3">cs_havana</option>
												<option value="4">cs_italy</option>
												<option value="5">cs_militia</option>
												<option value="6">cs_office</option>
												<option value="7">de_aztec</option>
												<option value="8">de_cbble</option>
												<option value="9">de_chateau</option>
												<option value="10">de_dust</option>
												<option value="11">de_dust2</option>
												<option value="12">de_inferno</option>
												<option value="13">de_nuke</option>
												<option value="14">de_piranesi</option>
												<option value="15">de_port</option>
												<option value="16">de_prodigy</option>
												<option value="17">de_tides</option>
												<option value="18">de_train</option>
												<option value="1">cs_assault</option>
												<option value="2">cs_compound</option>
											</select></td>
										<td><select id="buy_in" name="buy_in">
												<option value="">All</option>
												<option value="0,25">$0.25</option>
												<option value="125,500">$1.25-$5.00</option>
		<!--											
												<option value="501,1500">$5.01 - $15.00</option>
												<option value="1501,3000">$15.01 - $30.00</option>
												<option value="3001,5000">$30.01 - $50.00</option>
												<option value="5001,25000">$50.01 - $250.00</option>
												<option value="25001,50000">$250.01 - $500.00</option>
												<option value="50001">$500.01 and Up</option> -->
											</select></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1934">jaali challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1937">mamal challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>cs_havana</td>
										<td>1.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1969">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 8 )</td>
										<td>de_dust2</td>
										<td>22.0</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1927">Emir360 challenge</a></th>
										<td>12</td>
										<td>( 0 / 6 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1962">9MMEAG challenge</a></th>
										<td>20</td>
										<td>( 0 / 5 )</td>
										<td>cs_office</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1941">carnator challenge</a></th>
										<td>12</td>
										<td>( 0 / 2 )</td>
										<td>de_nuke</td>
										<td>0.25</td>
									</tr>
									<tr>
										<th><a href="/tournaments/1956">carnator challenge</a></th>
										<td>9</td>
										<td>( 0 / 2 )</td>
										<td>de_dust2</td>
										<td>0.25</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div><!-- #demo -->
					<div id="code">
						<h2>Code</h2>
						<div id="jquery">
							<h3 class="label">jQuery</h3>
							<pre>
<em>External jQuery file not found.</em>
							</pre>
						</div><!-- #jquery -->
						<div id="xhtml">
							<h3 class="label">XHTML</h3>
							<pre>
<em>External XHTML file not found.</em>
							</pre>
						</div><!-- #xhtml -->
						<div id="css">
							<h3 class="label">CSS</h3>
							<pre>
<em>External CSS file not found.</em>
							</pre>
						</div><!-- #css -->
					</div><!-- #code -->
