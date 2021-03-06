(function(){

	var ajaxInProgress = false;

	var _amountRequests = 0;
	var _spinner;
	var _spinnerCallback;

	var startSpin = function(amountRequests, $target, callback) {
		_amountRequests = amountRequests;
		_spinnerCallback = callback;
		_spinner = new Spinner({

		}).spin();

		$target[0].appendChild(_spinner.el);
	};

	var addSpin = function(am) {
		_amountRequests += am;
	};

	var stopSpin = function() {
		_amountRequests--;

		if (_amountRequests <= 0) {
			_spinner.stop();
			if (typeof _spinnerCallback === 'function') {
				_spinnerCallback();
			}
		}
	};



	var loadedBoards = function(boards) {
		var $boards = $('.js-trello-boards');
		$boards.empty();

		$.each(boards, function(index, value) {
			if (!value.closed) {
				$boards.append($("<option></option>").attr("value", value.id).text(value.name + ((value.starred) ? ' ★' : '') ));
			}
		});
	};

	var loadedLists = function(lists) {
		$lists = $('.js-trello-lists');
		$lists.empty();

		$.each(lists, function(index, value) {
			if (!value.closed) {
				$lists.append($("<option></option>").attr("value", value.id).text(value.name));
			}
		});
	};

	/**
	 * Load all boards the user is part of.
	 *
	 */
	var loadBoards = function() {
		//Get the users boards
		Trello.get(
			'/members/me/boards/',
			loadedBoards,
			function() {
				console.log("Failed to load boards");
			}
		);
	};

	/**
	 * Callback for a created card, appends a checklist to it.
	 *
	 */
	var createChecklist = function(data) {
		Trello.post('/checklists/', {
			idCard: data.id
		}, createdChecklist);
	};

	/**
	 * Callback for a created checklists, appends a items to it.
	 *
	 */
	var createdChecklist = function(data) {
		addSpin(checklist.items.length);
		stopSpin(); // created checklist card ;)

		$.each(checklist.items, function(i, item) {
			Trello.post('/checklists/' + data.id + '/checkItems/', {
				name: item.name
			}, function(data) {
				stopSpin();
			});
		});
	};


	$('.js-trello-open_modal').on('click', function() {

		if (Trello.authorized()) {

			// we are allready authorized, so load the boards and show modal
			$('#modal-trello').modal('show');
			loadBoards();

		} else {
			Trello.authorize({
				type: 'popup',
				name: 'Chcecklist Viewer',
				scope: {
					read: 'true',
					write: 'true'
				},
				expiration: 'never',
				success: function() {
					$('#modal-trello').modal('show');
					loadBoards();
				},
				error: function() {
					console.log('Failed to authorize user');
				}
			});
		}
	});

	$('.js-trello-boards').on('change', function() {

		var board_id = this.value;

		//Get lists of selected board
		Trello.get(
			'/boards/' + board_id + '/lists',
			loadedLists,
			function() {
				console.log("Failed to load lists for board " + board_id );
			}
		);
	});

	// add
	$('.js-trello-add_cards').on('click', function() {

		if($('.js-trello-individual').is(':checked')) {

			startSpin(checklist.items.length, $('.js-trello-add_cards'), function() {
				$('#modal-trello').modal('hide');
			});

			// add each checklist item as individual card
			$.each(checklist.items, function(i, item) {

				Trello.post('/cards/', {
					name: item.name,
					desc: item.description,
					idList: $('.js-trello-lists').val(),
				}, function(data) {
					stopSpin();
					// success
				});

			});
		} else {

			startSpin(1, $('.js-trello-add_cards'), function() {
				$('#modal-trello').modal('hide');
			});

			var newCard = {
				name: checklist.name,
				desc: document.location.href,

				// Place this card at the top of our list
				idList: $('.js-trello-lists').val(),
				pos: 'top'
			};

			Trello.post('/cards/', newCard, createChecklist);
		}
	});
})();

