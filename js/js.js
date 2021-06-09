let countries = [];
let players = [];
let stepPosition = 0;
let totalCountries = countries.length;
let totalPlayers = players.length;
let countriesPerPlayer = 0;
let floatingCountries = 0;
let countriesFull = 0;
let unnamed = 0;



const runQuickAssign = document.querySelector('.js-quickAssign');
runQuickAssign.addEventListener('click', () => {
	clearSweepstake();
	rollAllCountries();
});

const runStepAssign = document.querySelector('.js-stepAssign');
runStepAssign.addEventListener('click', () => {
	clearSweepstake();
	stepAssign();
});

const runClearSweeps = document.querySelector('.js-clearSweeps');
runClearSweeps.addEventListener('click', () => {
	clearSweepstake();
})

const runSingleAssign = document.querySelector('.js-singleAssign');
runSingleAssign.addEventListener('click', () => {
	if (stepPosition > 0) {
		// document.querySelector('.artist-holder').style.opacity = 0;
		// document.querySelector('.js-singingFor').style.opacity = 0;
		// document.querySelector('.assigned-to').style.opacity = 0;


		document.querySelector('.artist-holder').style.opacity = 0;
		document.querySelector('.js-singingFor').style.opacity = 0;
		document.querySelector('.assigned-to').style.opacity = 0;
		document.querySelector('.artist-holder').style.opacity = 0;
		document.querySelector('.js-wins').style.opacity = 0;
		document.querySelector('.js-euros').style.opacity = 0;
		document.querySelector('.js-probability').style.opacity = 0;
		document.querySelector('.js-best').style.opacity = 0;
		document.querySelector('.js-last').style.opacity = 0;
	}

	setTimeout(function() {
		// Slight delay to allow the above elements to fade out before switching the values around.
		singleAssign();
	}, 1000);
});



// Just in case someone wants to be able to quick assign / step through without refreshing.
function clearSweepstake() {
	shuffleArray(countries);

	countriesFull = 0;
	stepPosition = 0;

	for (i = 0; i < totalPlayers; i++) {
		players[i].countryCount = 0;
		players[i].assignedCountries = [];
	}

	cpu.countryCount = 0;
	cpu.assignedCountries = [];

	document.querySelector('.log-entries').innerHTML = '';
	document.querySelector('.assigns').innerHTML = '';
	document.querySelector('#stt-currentCountry').innerText = '0';
}



function rollAllCountries() {
	let i = 0;
	let playerListContainer = document.querySelector('.assigns');
	
	if (i === 0) {
		playerListContainer.style.display = 'none';
		playerListContainer.style.opacity = 0;
		playerListContainer.style.transition = 'opacity .3s ease-in';
	}

	for (i = 0; i < totalCountries; i++) {
		document.querySelector('#stt-currentCountry').innerText = i + 1;

		let thisDiv = document.createElement('div');
			thisDiv.id = 'roll-all_'+i;
			thisDiv.className = 'roll-all-entry';

		let countrySafe = countries[i].iso.toLowerCase();

		if (countriesFull == totalPlayers) {
			cpu.incrementCountryCount();
			cpu.assignCountry(countries[i]);

			thisDiv.innerHTML = `<span class="flag-country"><img src="flags/1x1/${countrySafe}.svg" width="20" height="20">${countries[i].country}</span><div> assigned to ${cpu.name}</div>`;
			document.querySelector('.log-entries').insertAdjacentElement('beforeend', thisDiv);
		} else {
			playerNumber = randomPlayer();

			thisDiv.innerHTML = `<span class="flag-country"><img src="flags/1x1/${countrySafe}.svg" width="20" height="20">${countries[i].country}</span><div> assigned to ${players[playerNumber].name}</div>`;
			document.querySelector('.log-entries').insertAdjacentElement('beforeend', thisDiv);

			players[playerNumber].incrementCountryCount();
			players[playerNumber].assignCountry(countries[i]);

			if (players[playerNumber].countryCount == countriesPerPlayer) countriesFull++;
		}
	}

	if (cpu.countryCount > 0) players.push(cpu);

	if (i === totalCountries) {
		setTimeout(function() {
			for (j = 0; j < totalCountries; j++) {
				document.querySelector('#roll-all_'+j).style.opacity = 1;
			}
		}, 100);

		setTimeout(function() {
			playerListContainer.style.display = 'flex';
			playerListContainer.style.opacity = 1;
		}, 300);
	}

	updatePlayerBlocks();
}



function buildArtist() {
	let domAssigned = document.createElement('div');
		domAssigned.classList.add('assigned');

	let domArtistHolder = document.createElement('div');
		domArtistHolder.classList.add('artist-holder');

	let domSlideContainer = document.createElement('div');
		domSlideContainer.classList.add('slide-container');

	let domArtistImgHolder = document.createElement('div');
		domArtistImgHolder.classList.add('artist-img', 'slide-image');
	
	let domArtistImg = document.createElement('img');
		domArtistImg.classList.add('js-artistImg');
		domArtistImg.height = '390';

	let domTeamGroup = document.createElement('div');
		domTeamGroup.classList.add('team-group');

	let domArtistCountry = document.createElement('div');
		domArtistCountry.classList.add('artist-country');

	let domCountryFlag = document.createElement('img');
		domCountryFlag.classList.add('js-countryImg');
		domCountryFlag.width = '20';
		domCountryFlag.height = '20';

	let domCountryText = document.createElement('span');
		domCountryText.classList.add('js-countryText');

	let domInGroup = document.createElement('div');
		domInGroup.classList.add('in-group');

	let domGroupText = document.createElement('span');
		domGroupText.classList.add('js-groupText');

	let domSingingFor = document.createElement('h3');
		domSingingFor.classList.add('js-singingFor');
		domSingingFor.innerText = 'Playing For';

	let domAssignedTo = document.createElement('div');
		domAssignedTo.classList.add('assigned-to');

	let domStats = document.createElement('div');
		domStats.classList.add('js-stats');
	
	let domStatWins = document.createElement('div');
		domStatWins.innerText = 'No. of Wins';
		domStatWins.classList.add('stat', 'js-wins');

	let domStatWinsValue = document.createElement('strong');

	let domStatEuros = document.createElement('div');
		domStatEuros.innerText = 'No. of Euros';
		domStatEuros.classList.add('stat', 'js-euros');
	
	let domStatEurosValue = document.createElement('strong');

	let domStatProb = document.createElement('div');
		domStatProb.innerText = 'Win Probability';
		domStatProb.classList.add('stat', 'js-probability');

	let domStatProbValue = document.createElement('strong');

	let domStatBest = document.createElement('div');
		domStatBest.innerText = 'Best Finish';
		domStatBest.classList.add('stat', 'js-best');

	let domStatBestValue = document.createElement('strong');

	let domStatLast = document.createElement('div');
		domStatLast.innerText = '2016 Result';
		domStatLast.classList.add('stat', 'js-last');

	let domStatLastValue = document.createElement('strong');

	domAssigned.appendChild(domArtistHolder);
		domArtistHolder.appendChild(domSlideContainer);
			domSlideContainer.appendChild(domArtistImgHolder);
				domArtistImgHolder.appendChild(domArtistImg);
		domArtistHolder.appendChild(domTeamGroup);
			domTeamGroup.appendChild(domArtistCountry);
				domArtistCountry.appendChild(domCountryFlag);
				domArtistCountry.appendChild(domCountryText);
			domTeamGroup.appendChild(domInGroup);
				domInGroup.appendChild(domGroupText);
		domArtistHolder.appendChild(domSingingFor);
		domArtistHolder.appendChild(domAssignedTo);
		domArtistHolder.appendChild(domStats);
			domStats.appendChild(domStatWins);
				domStatWins.appendChild(domStatWinsValue);
			domStats.appendChild(domStatEuros);
				domStatEuros.appendChild(domStatEurosValue);
			domStats.appendChild(domStatProb);
				domStatProb.appendChild(domStatProbValue);
			domStats.appendChild(domStatBest);
				domStatBest.appendChild(domStatBestValue);
			domStats.appendChild(domStatLast);
				domStatLast.appendChild(domStatLastValue);

	document.querySelector('.log-entries').appendChild(domAssigned);
}



function startSweep() {
	loadPlayerHolders();

	document.querySelector('.js-assignInfo').style.opacity = 1;
	document.querySelector('#stt-countriesTotal').innerText = totalCountries;

	buildArtist();
}



function setNextCountry(timerPlayerNameIn, timerCountryNameIn, timerFlagGrow, timerStart) {
	currCountryFlag = countries[stepPosition].iso.toLowerCase();
	currCountryName = countries[stepPosition].country;
	currCountryGroup = countries[stepPosition].group;
	currCountryProbability = countries[stepPosition].probability;

	document.querySelector('#stt-currentCountry').innerText = stepPosition + 1;

	document.querySelector('.js-artistImg').src = `flags/4x3/${currCountryFlag}.svg`;
	document.querySelector('.js-countryImg').src = `flags/4x3/${currCountryFlag}.svg`;
	document.querySelector('.js-countryText').innerText = currCountryName;
	document.querySelector('.js-groupText').innerText = `Group ${currCountryGroup}`;
	document.querySelector('.js-wins strong').innerText = countries[stepPosition].wins;
	document.querySelector('.js-euros strong').innerText = countries[stepPosition].qualified;
	document.querySelector('.js-probability strong').innerText = countries[stepPosition].probability+'%';
	document.querySelector('.js-best strong').innerText = countries[stepPosition].best;
	document.querySelector('.js-last strong').innerText = countries[stepPosition].last;

	setTimeout(function() {
		setTimeout(function() {
			document.querySelector('.artist-holder').style.opacity = 1;

			setTimeout(function() {
				document.querySelector('.js-wins').style.opacity = 1;

				setTimeout(function() {
					document.querySelector('.js-euros').style.opacity = 1;

					setTimeout(function() {
						document.querySelector('.js-probability').style.opacity = 1;

						setTimeout(function() {
							document.querySelector('.js-best').style.opacity = 1;

							setTimeout(function() {
								document.querySelector('.js-last').style.opacity = 1;
							}, 500);
						}, 500);
					}, 500);
				}, 500);
			}, 1000);

			setTimeout(function() {
				document.querySelector('.js-singingFor').style.opacity = 1;

				setTimeout(function() {
					document.querySelector('.assigned-to').style.opacity = 1;
				}, timerPlayerNameIn);
			}, timerCountryNameIn);
		}, timerFlagGrow);
	}, timerStart);
}



function assignCountryTo(playerName, playerNumber, tableRow, timerPanelName) {
	document.querySelector('.assigned-to').innerText = playerName;

	let tbl = document.querySelector('#player-table_'+(playerNumber));
	let rows = tbl.rows;
	rows[tableRow].cells[0].innerHTML = `<img src="flags/1x1/${currCountryFlag}.svg" width="20" height="20">`;
	rows[tableRow].cells[1].innerHTML = `${currCountryName}<br>Group ${currCountryGroup}, ${currCountryProbability}% Chance`;

	setTimeout(function() {
		rows[tableRow].classList.add('is-visible');
	}, timerPanelName);
}



function assignCPU(timerPanelName) {
	cpu.incrementCountryCount();
	cpu.assignCountry(countries[stepPosition]);

	if (cpu.countryCount === 1) players.push(cpu);

	assignCountryTo(cpu.name, totalPlayers, cpu.countryCount - 1, timerPanelName);
}



function assignPlayer(timerPanelName) {
	playerNumber = randomPlayer();

	document.querySelector('.assigned-to').innerText = players[playerNumber].name;

	assignCountryTo(players[playerNumber].name, playerNumber, players[playerNumber].countryCount, timerPanelName);

	players[playerNumber].incrementCountryCount();
	players[playerNumber].assignCountry(countries[stepPosition]);

	if (stepPosition < totalCountries && players[playerNumber].countryCount == countriesPerPlayer) countriesFull++;
}



function singleAssign() {
	let timerStart = 1000;
	let timerFlagGrow = 100;
	let timerCountryNameIn = 3000;
	let timerPlayerNameIn = 3000;
	let timerPanelName = timerStart + timerFlagGrow + timerCountryNameIn + timerPlayerNameIn;

	if (stepPosition == 0) startSweep();

	if (stepPosition < totalCountries) {
		setNextCountry(timerPlayerNameIn, timerCountryNameIn, timerFlagGrow, timerStart);

		if (countriesFull === totalPlayers) {
			assignCPU(timerPanelName);
		} else {
			assignPlayer(timerPanelName);
		}

		stepPosition++;
	}
}



function stepAssign() {
	let timerStart = 1000;
	let timerFlagGrow = 100;
	let timerCountryNameIn = 3000;
	let timerPlayerNameIn = 3000;
	let timerPanelName = timerStart + timerFlagGrow + timerCountryNameIn + timerPlayerNameIn;
	let timerNextCountry = 10000;

	if (stepPosition == 0) startSweep();

	if (stepPosition < totalCountries) {
		setNextCountry(timerPlayerNameIn, timerCountryNameIn, timerFlagGrow, timerStart);

		if (countriesFull === totalPlayers) {
			assignCPU(timerPanelName);
		} else {
			assignPlayer(timerPanelName);
		}

		stepPosition++;

		setTimeout(function() {
			document.querySelector('.artist-holder').style.opacity = 0;
			document.querySelector('.js-singingFor').style.opacity = 0;
			document.querySelector('.assigned-to').style.opacity = 0;
			document.querySelector('.artist-holder').style.opacity = 0;
			document.querySelector('.js-wins').style.opacity = 0;
			document.querySelector('.js-euros').style.opacity = 0;
			document.querySelector('.js-probability').style.opacity = 0;
			document.querySelector('.js-best').style.opacity = 0;
			document.querySelector('.js-last').style.opacity = 0;
		}, (timerNextCountry - timerStart));

		setTimeout(function() {
			stepAssign();
		}, timerNextCountry);
	}
}



// Because apparenly I can't use country as a function name, it complains about constructors.
function acountry(group, country, iso, probability, timesQualified, HighestFinish, Wins, LastComp) {
	this.group = group;
	this.country = country;
	this.iso = iso;
	this.probability = probability;
	this.qualified = timesQualified;
	this.best = HighestFinish;
	this.wins = Wins;
	this.last = LastComp;
}



function addCountry(group, country, iso, probability, timesQualified, HighestFinish, Wins, LastComp) {
	countries.push(new acountry(group, country, iso, probability, timesQualified, HighestFinish, Wins, LastComp));
	shuffleArray(countries);
	updateTotalStats();
}



function player(name) {
	this.name = name;
	this.countryCount = 0;
	this.assignedCountries = [];

	this.assignCountry = (country) => {
		this.assignedCountries.push(country);
	}

	this.incrementCountryCount = (amount = 1) => {
		this.countryCount += amount;
	}
}



function addPlayer(name) {
	var name = name == undefined ? document.getElementById('playerName').value : name;

	if (name == '') {
		unnamed++;
		name = 'Unnamed ' + unnamed;
	}

	let playerDiv = document.createElement('div');
		playerDiv.style.opacity = 0;
		playerDiv.style.transition = 'opacity .5s ease-in';
		playerDiv.innerText = name;

	document.getElementById('playerList').insertAdjacentElement('beforeend', playerDiv);
	setTimeout(function() {
		playerDiv.style.opacity = 1;
	}, 100);

	players.push(new player(name));
	players.sort();

	updateTotalStats();
}



function randomPlayer() {
	let player = Math.floor(Math.random() * totalPlayers);

	return players[player].countryCount == countriesPerPlayer ? randomPlayer() : player;
}



function shuffleArray(array) {
	for (let i = array.length - 1; i > 0; i--) {
		const j = Math.floor(Math.random() * (i + 1));
		[array[i], array[j]] = [array[j], array[i]];
	}
}



function updatePlayerBlocks() {
	let playersContainer = document.querySelector('.assigns');
	let playerBlock;
	let j = 0;
	let i = 0;

	for (i = 0; i < totalPlayers; i++) {
		playerBlock  = '<div class="profile">';
		playerBlock += '<h2>'+players[i].name+'</h2>';
		playerBlock += '<table class="table profile-stats">'; // I really shouldn't be using tables but this was a C&P from some old code that also had score columns and such. Change later.
		playerBlock += '<tbody>';

		let playerCountriesCount = players[i].countryCount;
		for (j = 0; j < playerCountriesCount; j++) {
			playerBlock += '<tr>';
			playerBlock += `<td><img src="flags/1x1/${players[i].assignedCountries[j].iso.toLowerCase()}.svg" width="20" height="20"></td>`;
			playerBlock += `<td>${players[i].assignedCountries[j].country}<br>Group ${players[i].assignedCountries[j].group}, ${players[i].assignedCountries[j].probability}% Chance</td>`;
			playerBlock += '</tr>';
		}

		playerBlock += '</tbody>';
		playerBlock += '</table>';
		playerBlock += '</div>';

		playersContainer.insertAdjacentHTML('beforeend', playerBlock);
	}

	if (cpu.countryCount > 0) {
		playerBlock  = '<div class="profile">';
		playerBlock += '<h2>'+cpu.name+'</h2>';
		playerBlock += '<table class="table profile-stats">';
		playerBlock += '<tbody>';

		cpuCountriesCount = cpu.countryCount;
		for (j = 0; j < cpuCountriesCount; j++) {
			playerBlock += '<tr>';
			playerBlock += `<td><img src="flags/1x1/${cpu.assignedCountries[j].iso.toLowerCase()}.svg" width="20" height="20"></td>`;
			playerBlock += `<td>${cpu.assignedCountries[j].country}<br>Group ${cpu.assignedCountries[j].group}, ${cpu.assignedCountries[j].probability}% Chance</td>`;
			playerBlock += '</tr>';
		}

		playerBlock += '</tbody>';
		playerBlock += '</table>';
		playerBlock += '</div>';

		playersContainer.insertAdjacentHTML('beforeend', playerBlock);
	}
}



function updateTotalStats() {
	totalCountries = countries.length;
	totalPlayers = players.length;
	countriesPerPlayer = totalPlayers > 0 ? Math.floor(totalCountries / totalPlayers) : 0;
	floatingCountries = totalPlayers > 0 ? totalCountries - (countriesPerPlayer * totalPlayers) : totalCountries;

	document.querySelector('#countryCount').innerText = totalCountries;
	document.querySelector('#playerCount').innerText = cpu.countryCount > 0 ? totalPlayers - 1 : totalPlayers;
	document.querySelector('#countriesPerPlayer').innerText = countriesPerPlayer;
	document.querySelector('#floatingCountries').innerText = floatingCountries;
	document.querySelector('#stt-countriesTotal').innerText = totalCountries;
}



function createPlayerBlock(id, name, override) {
	playerBlock  = '<div class="profile">';
	playerBlock += '<h2>'+name+'</h2>';
	playerBlock += '<table class="table profile-stats">';
	playerBlock += '<tbody id="player-table_'+id+'">';

	let i = 0;
	let placeholders = override != undefined ? override : countriesPerPlayer;
	for (i = 0; i < placeholders; i++) {
		playerBlock += '<tr id="country_'+i+'" class="toggle-content"><td>&nbsp;</td><td>&nbsp;</td></tr>';
	}

	playerBlock += '</tbody>';
	playerBlock += '</table>';
	playerBlock += '</div>';

	document.querySelector('.assigns').insertAdjacentHTML('beforeend', playerBlock);
}



function loadPlayerHolders() {
	for (i = 0; i < totalPlayers; i++) {
		createPlayerBlock(i, players[i].name);
	}

	if (floatingCountries > 0) {
		createPlayerBlock(i, cpu.name, floatingCountries);
	}
}