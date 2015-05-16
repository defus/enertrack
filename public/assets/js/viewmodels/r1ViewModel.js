r1ViewModel = function() {
	var self = this;
	// ViewModel.call(self);

	self.records = ko.observableArray([]);
	self.justYearsRecord = ko.observableArray([]);
	self.patrimoinesRecord = ko.observableArray([]);

	self.isFetchingData = ko.observableArray(false);

	self.availableYears = ko.computed(function() {
		var data = self.records();
		var retVal = [];

		ko.utils.arrayForEach(data, function(item) {
			if (item.annee && retVal.indexOf(item.annee) < 0)
				retVal.push(item.annee);
		});

		return retVal;

	}, self);

	self.isFetchingData.subscribe(function(newValue) {
		if (newValue == true) {

		} else {

		}
	}, self);

	self.availableJustYears = ko.computed(function() {
		var data = self.justYearsRecord();
		var retVal = [];

		ko.utils.arrayForEach(data, function(item) {
			if (item.annee && retVal.indexOf(item.annee) < 0)
				retVal.push(item.annee);
		});
		console.log("Available Just Years", retVal);
		return retVal;

	}, self);

	self.isFetchingData.subscribe(function(newValue) {
		if (newValue == true) {

		} else {

		}
	}, self);

	self.drawnYears = ko.observableArray([]);
	self.drawnOnlyYears = ko.observableArray([]);
	self.drawnPatrimoines = ko.observableArray([]);

};

r1ViewModel.prototype.startLoadingData = function(dataLink, isYearly) {
	var self = this;
	// TODO
	var promesse = $.ajax({
		url : dataLink,
		type : "POST",
		dataType : "JSON",
		data : {
			cmd : "get-records"
		}
	});

	promesse.done(function(data, status, ss) {
		// console.log('Done Data', ko.toJSON(self));
		if ("success" == data.status && isYearly != true)
			self.records(data.records);
		else if ("success" == data.status && isYearly == true) {
			self.justYearsRecord(data.records);
		} else {
			console.log('Fail Data', data);
		}
	});

	promesse.fail(function(data, status, ss) {
		console.log('Fail Data', data);

	});

};

r1ViewModel.prototype.handleNoTrimestre = function(year, trimestre) {
	var self = this;
	var holder = self.buildTrimestreGraphId(year, trimestre);

	$("#" + holder).text("Aucune donnée pour le Trimestre " + trimestre);

};

r1ViewModel.prototype.hasTrimestre = function(year, trimestre) {
	var self = this;
	var data = self.getTrimestreData(year, trimestre);

	if (!data) {
		return false;
	}

	return true;
};

r1ViewModel.prototype.getTableData = function(year, trimestre) {
	var self = this;

	var data = trimestre ? self.getTrimestreData(year, trimestre) : self
			.getJustYearData(year);

	if (!data) {
		if (trimestre)
			self.handleNoTrimestre(year, trimestre);
		return;
	}

	// var tablePlaceHolder = self.buildTrimestreTableId(year, trimestre);

	// TODO draw trimestre table
	// categories order : b,e,v,ev,ae,pp,ap,unknown

	var tableData = [ {
		name : 'Bâtiments',
		total : data.total_b,
		eau : data.total_eau_b,
		energie : data.total_energie_b,
		conso : data.conso_b
	}, {
		name : 'Eclairages Publics',
		total : data.total_e,
		eau : data.total_eau_e,
		energie : data.total_energie_e,
		conso : data.conso_e
	}, {
		name : 'Véhicules',
		total : data.total_v,
		eau : data.total_eau_v,
		energie : data.total_energie_v,
		conso : data.conso_v
	}, {
		name : 'Espaces Verts',
		total : data.total_ev,
		eau : data.total_eau_ev,
		energie : data.total_energie_ev,
		conso : data.conso_ev
	}, {
		name : "Points d'Eaux",
		total : data.total_ae,
		eau : data.total_eau_ae,
		energie : data.total_energie_ae,
		conso : data.conso_ae
	}, {
		name : "Postes de Productions",
		total : data.total_pp,
		eau : data.total_eau_pp,
		energie : data.total_energie_pp,
		conso : data.conso_pp
	}, {
		name : "Autres Postes",
		total : data.total_ap,
		eau : data.total_eau_ap,
		energie : data.total_energie_ap,
		conso : data.conso_ap
	}, {
		name : "Non Catégorisés",
		total : data.total_unknown,
		eau : data.total_eau_unknown,
		energie : data.total_energie_unknown,
		conso : data.conso_unknown
	} ];

	return tableData;

};

r1ViewModel.prototype.drawTrimestre = function(year, trimestre) {
	var self = this;
	var data = self.getTrimestreData(year, trimestre);

	if (!data) {
		self.handleNoTrimestre(year, trimestre);
		return;
	}

	var graphPlaceHolder = self.buildTrimestreGraphId(year, trimestre);
	// var tablePlaceHolder = self.buildTrimestreTableId(year, trimestre);

	// TODO draw trimestre
	// categories order : b,e,v,ev,ae,pp,ap,unknown
	var theCategories = [ 'Bâtiments', 'Eclairages Publics', 'Véhicules',
			'Espaces Verts', "Points d'Eaux", "Postes de Productions",
			"Autres Postes", "Non Catégorisés" ];

	var splineSerie = {
		name : 'Coût TTC',
		type : 'spline',
		data : [ 1 * data.total_b, 1 * data.total_e, 1 * data.total_v,
				1 * data.total_ev, 1 * data.total_ae, 1 * data.total_pp,
				1 * data.total_ap, 1 * data.total_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : true
		}
	};

	var splineSerieEau = {
		name : 'Total Coûts Eaux TTC',
		type : 'spline',
		data : [ 1 * data.total_eau_b, 1 * data.total_eau_e,
				1 * data.total_eau_v, 1 * data.total_eau_ev,
				1 * data.total_eau_ae, 1 * data.total_eau_pp,
				1 * data.total_eau_ap, 1 * data.total_eau_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : false
		}
	};

	var splineSerieEnergie = {
		name : 'Total Coûts Energie TTC',
		type : 'spline',
		data : [ 1 * data.total_energie_b, 1 * data.total_energie_e,
				1 * data.total_energie_v, 1 * data.total_energie_ev,
				1 * data.total_energie_ae, 1 * data.total_energie_pp,
				1 * data.total_energie_ap, 1 * data.total_energie_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : false
		}
	};

	var columnSerie = {
		name : 'Consommation',
		type : 'column',
		yAxis : 1,
		data : [ 1 * data.conso_b, 1 * data.conso_e, 1 * data.conso_v,
				1 * data.conso_ev, 1 * data.conso_ae, 1 * data.conso_pp,
				1 * data.conso_ap, 1 * data.conso_unknown ],
		tooltip : {
			valueSuffix : ' (kWh/M3/l)'
		}

	};

	var pieSerie = {
		type : 'pie',
		name : 'Répartitions des Coûts',
		data : [ {
			name : 'Bâtiments',
			y : 1 * data.total_b,
			color : Highcharts.getOptions().colors[0]

		}, {
			name : 'Eclairages Publics',
			y : 1 * data.total_e,
			color : Highcharts.getOptions().colors[1]

		}, {
			name : 'Véhicules',
			y : 1 * data.total_v,
			color : Highcharts.getOptions().colors[2]

		}, {
			name : 'Espaces Verts',
			y : 1 * data.total_ev,
			color : Highcharts.getOptions().colors[3]

		}, {
			name : "Points d'Eaux",
			y : 1 * data.total_ae,
			color : Highcharts.getOptions().colors[4]

		}, {
			name : 'Postes de Productions',
			y : 1 * data.total_pp,
			color : Highcharts.getOptions().colors[5]

		}, {
			name : 'Autres Postes',
			y : 1 * data.total_ap,
			color : Highcharts.getOptions().colors[6]

		}, {
			name : 'Non Catégorisés',
			y : 1 * data.total_unknown,
			color : Highcharts.getOptions().colors[7]

		} ],
		center : [ 500, 100 ],
		size : 100,
		showInLegend : false,
		dataLabels : {
			enabled : true,
			cursor : 'pointer',
			format : '<b>{point.name}</b>: {point.percentage:.1f} %',
		}
	};

	var options = {
		chart : {
			zoomType : 'xy'
		},
		title : {
			text : 'Coûts et Consommations du Trimestre ' + trimestre
		},
		subtitle : {
			text : ''
		},
		xAxis : [ {
			categories : theCategories,
			crosshair : true
		} ],
		yAxis : [ {
			categories : theCategories,
			crosshair : true
		} ],
		yAxis : [ { // Primary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[1]
				}
			},
			title : {
				text : 'Totaux Coûts TTC',
				style : {
					color : Highcharts.getOptions().colors[1]
				}
			},
			opposite : true
		}, { // secondary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[2]
				}
			},
			title : {
				text : 'Coûts Energies TTC',
				style : {
					color : Highcharts.getOptions().colors[2]
				}
			}
		}, { // secondary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[3]
				}
			},
			title : {
				text : 'Coûts Eaux TTC',
				style : {
					color : Highcharts.getOptions().colors[3]
				}
			}
		}, { // Third yAxis
			title : {
				text : 'Consommation',
				style : {
					color : Highcharts.getOptions().colors[0]
				}
			},
			labels : {
				format : '{value} (kWh/M3/l)',
				style : {
					color : Highcharts.getOptions().colors[0]
				}
			},
			opposite : true
		} ],
		tooltip : {
			shared : true
		},
		legend : {
			layout : 'vertical',
			align : 'left',
			x : 120,
			verticalAlign : 'top',
			y : 20,
			floating : true,
			backgroundColor : (Highcharts.theme && Highcharts.theme.legendBackgroundColor)
					|| '#FFFFFF'
		},
		series : [ columnSerie, splineSerie, splineSerieEnergie,
				splineSerieEau, pieSerie ]
	};

	console.log(options);

	$('#' + graphPlaceHolder).highcharts(options);

};

r1ViewModel.prototype.drawYear = function(year, yearly) {

	var self = this;

	if (yearly == true) {
		if (self.drawnOnlyYears().indexOf(year) >= 0)
			return;
		self.drawJustYear(year);
		return;
	}

	if (self.drawnYears().indexOf(year) >= 0)
		return;

	self.drawTrimestre(year, 1);
	self.drawTrimestre(year, 2);
	self.drawTrimestre(year, 3);
	self.drawTrimestre(year, 4);

	self.drawnYears.push(year);

};

r1ViewModel.prototype.drawYearPatrimoine = function(year, patrimoine) {

	var self = this;

	if (self.drawnPatrimoines().indexOf(year + '' + patrimoine) >= 0)
		return;
	// TODO really draw year patrimoine report
	console.log("Here I'm going to draw it");

	var pieSerieDataCosts = [];
	var pieSerieDataConso = [];
	var couleur = 0;

	ko.utils.arrayForEach(self.patrimoinesRecord(), function(entry) {
		if (entry && entry.annee == year) {
			pieSerieDataCosts.push({
				name : entry.energie,
				y : 1 * entry['total_' + patrimoine],
				color : Highcharts.getOptions().colors[couleur]
			});
			pieSerieDataConso.push({
				name : entry.energie,
				y : 1 * entry['conso_' + patrimoine],
				color : Highcharts.getOptions().colors[couleur]
			});
			color++;
		}
	});

	self.drawnPatrimoines.push(year + '' + patrimoine);

};

r1ViewModel.prototype.getJustYearData = function(year) {
	var self = this;
	var records = self.justYearsRecord();
	// TODO get year data

	var retVal = null;

	retVal = ko.utils.arrayFirst(records, function(entry) {
		return entry && entry.annee == year;
	});
	if (!retVal)
		return retVal;

	return retVal;
};

r1ViewModel.prototype.getPatrimoinesData = function(year) {
	var self = this;
	var records = self.patrimoinesRecord();

	var retVal = null;

	retVal = ko.utils.arrayFirst(records, function(entry) {
		return entry && entry.annee == year;
	});
	if (!retVal)
		return retVal;

	return retVal;
};

r1ViewModel.prototype.getTrimestreData = function(year, trimestre) {
	var self = this;
	var records = self.records();
	// TODO get trimestre data

	var retVal = null;
	console.log('Get Data For ', year, trimestre);

	retVal = ko.utils.arrayFirst(records, function(entry) {

		return entry && entry.annee == year && entry.trimestre == trimestre;
	});

	return retVal;
};

r1ViewModel.prototype.formatBigNumber = function(number) {
	var self = this;
	var retVal = 1 * number;
	// TODO format the number
	return retVal;
};

r1ViewModel.prototype.buildTrimestreGraphId = function(year, trimestre) {
	var self = this;
	return '' + year + 'trimestre_' + trimestre;
};

r1ViewModel.prototype.buildTrimestreTableId = function(year, trimestre) {
	var self = this;
	return 'table_' + year + 'trimestre_' + trimestre;
};

r1ViewModel.prototype.getYearTrimestres = function(year) {
	var self = this;
	var records = self.records();
	// TODO get year trimestres
};

r1ViewModel.prototype.drawJustYear = function(year) {
	var self = this;
	var data = self.getJustYearData(year);
	console.log("Draw Just Year " + year, data);

	var graphPlaceHolder = "just_year_" + year;

	// TODO draw trimestre
	// categories order : b,e,v,ev,ae,pp,ap,unknown
	var theCategories = [ 'Bâtiments', 'Eclairages Publics', 'Véhicules',
			'Espaces Verts', "Points d'Eaux", "Postes de Productions",
			"Autres Postes", "Non Catégorisés" ];

	var splineSerie = {
		name : 'Coût TTC',
		type : 'spline',
		data : [ 1 * data.total_b, 1 * data.total_e, 1 * data.total_v,
				1 * data.total_ev, 1 * data.total_ae, 1 * data.total_pp,
				1 * data.total_ap, 1 * data.total_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : true
		}
	};

	var splineSerieEau = {
		name : 'Total Coûts Eaux TTC',
		type : 'spline',
		data : [ 1 * data.total_eau_b, 1 * data.total_eau_e,
				1 * data.total_eau_v, 1 * data.total_eau_ev,
				1 * data.total_eau_ae, 1 * data.total_eau_pp,
				1 * data.total_eau_ap, 1 * data.total_eau_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : false
		}
	};

	var splineSerieEnergie = {
		name : 'Total Coûts Energie TTC',
		type : 'spline',
		data : [ 1 * data.total_energie_b, 1 * data.total_energie_e,
				1 * data.total_energie_v, 1 * data.total_energie_ev,
				1 * data.total_energie_ae, 1 * data.total_energie_pp,
				1 * data.total_energie_ap, 1 * data.total_energie_unknown ],
		tooltip : {
			valueSuffix : 'MAD'
		},
		dataLabels : {
			enabled : false
		}
	};

	var columnSerie = {
		name : 'Consommation',
		type : 'column',
		yAxis : 1,
		data : [ 1 * data.conso_b, 1 * data.conso_e, 1 * data.conso_v,
				1 * data.conso_ev, 1 * data.conso_ae, 1 * data.conso_pp,
				1 * data.conso_ap, 1 * data.conso_unknown ],
		tooltip : {
			valueSuffix : ' (kWh/M3/l)'
		}

	};

	var pieSerie = {
		type : 'pie',
		name : 'Répartitions des Coûts',
		data : [ {
			name : 'Bâtiments',
			y : 1 * data.total_b,
			color : Highcharts.getOptions().colors[0]

		}, {
			name : 'Eclairages Publics',
			y : 1 * data.total_e,
			color : Highcharts.getOptions().colors[1]

		}, {
			name : 'Véhicules',
			y : 1 * data.total_v,
			color : Highcharts.getOptions().colors[2]

		}, {
			name : 'Espaces Verts',
			y : 1 * data.total_ev,
			color : Highcharts.getOptions().colors[3]

		}, {
			name : "Points d'Eaux",
			y : 1 * data.total_ae,
			color : Highcharts.getOptions().colors[4]

		}, {
			name : 'Postes de Productions',
			y : 1 * data.total_pp,
			color : Highcharts.getOptions().colors[5]

		}, {
			name : 'Autres Postes',
			y : 1 * data.total_ap,
			color : Highcharts.getOptions().colors[6]

		}, {
			name : 'Non Catégorisés',
			y : 1 * data.total_unknown,
			color : Highcharts.getOptions().colors[7]

		} ],
		center : [ 500, 100 ],
		size : 100,
		showInLegend : false,
		dataLabels : {
			enabled : true,
			cursor : 'pointer',
			format : '<b>{point.name}</b>: {point.percentage:.1f} %',
		}
	};

	var options = {
		chart : {
			zoomType : 'xy'
		},
		title : {
			text : 'Coûts et Consommations ' + year
		},
		subtitle : {
			text : ''
		},
		xAxis : [ {
			categories : theCategories,
			crosshair : true
		} ],
		yAxis : [ {
			categories : theCategories,
			crosshair : true
		} ],
		yAxis : [ { // Primary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[1]
				}
			},
			title : {
				text : 'Totaux Coûts TTC',
				style : {
					color : Highcharts.getOptions().colors[1]
				}
			},
			opposite : true
		}, { // secondary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[2]
				}
			},
			title : {
				text : 'Coûts Energies TTC',
				style : {
					color : Highcharts.getOptions().colors[2]
				}
			}
		}, { // secondary yAxis
			labels : {
				format : '{value} MAD',
				style : {
					color : Highcharts.getOptions().colors[3]
				}
			},
			title : {
				text : 'Coûts Eaux TTC',
				style : {
					color : Highcharts.getOptions().colors[3]
				}
			}
		}, { // Third yAxis
			title : {
				text : 'Consommation',
				style : {
					color : Highcharts.getOptions().colors[0]
				}
			},
			labels : {
				format : '{value} (kWh/M3/l)',
				style : {
					color : Highcharts.getOptions().colors[0]
				}
			},
			opposite : true
		} ],
		tooltip : {
			shared : true
		},
		legend : {
			layout : 'vertical',
			align : 'left',
			x : 120,
			verticalAlign : 'top',
			y : 20,
			floating : true,
			backgroundColor : (Highcharts.theme && Highcharts.theme.legendBackgroundColor)
					|| '#FFFFFF'
		},
		series : [ columnSerie, splineSerie, splineSerieEnergie,
				splineSerieEau, pieSerie ]
	};

	console.log(options);

	$('#' + graphPlaceHolder).highcharts(options);

	self.drawnOnlyYears.push(year);

};
