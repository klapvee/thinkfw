
	$(function() 
	{
		//console.log('load the darin thing');
	});
	
	function answerQuestionOpen()
	{
		var answer = document.getElementById('answer').value;
		
		if (answer == '')
		{
			
			return false;
		}
		
		$.ajax({
			url: '/play/answer',
			dataType: 'json',
			data: 'answer=' + answer,
			type: 'post',
			success: function(data)
			{
				global = data;
				var points = Number(document.getElementById('points').innerHTML);
				var strPoints = points + data.points;
				
				document.getElementById('points').innerHTML = strPoints;
				
				$.fancybox({
					'autoScale'		: false,
					'transitionIn'	: 'none',
					'transitionOut'	: 'none',
					'width'			: 680,
					'height'		: 495,
					'href'			: '/play/info',
					'onClosed'		: function()
					{
						showNext();
					}
				});
			},
			error: function(e, t)
			{
				console.log('error: ' + t);
			}
		});
	}
	
	function showNext()
	{
		var nr = Number(document.getElementById('number').innerHTML);
		document.getElementById('number').innerHTML = nr + 1;
		document.getElementById('category').innerHTML = global.category;
		document.getElementById('questionbox').innerHTML = global.question;
		document.getElementById('answer').value = '';
		
		if (global.id_type == 1)
		{
			document.getElementById('answer_box_open').style.display = 'block';
			document.getElementById('answer_box_mp').style.display = 'none';
		} else {
			
			document.getElementById('answer_box_open').style.display = 'none';
			document.getElementById('answer_box_mp').style.display = 'open';
			document.getElementById('answer_box_mp').innerHTML = '';
			
			for (var i = 0; i < global.answers.length; i++)
			{
				var d = document.createElement('DIV');
				var da = new Date();
				var _id = '_' + da.getTime();
				
				d.innerHTML = global.answers[i];
				d.id = _id;
				d.onclick = function()
				{
					setMpAnswer(this);
				}
				
				document.getElementById('answer_box_mp').appendChild(d);
				
			}
			//answer_box_mp
		}
			
		$.fancybox.close();
	}
	
	function answerQuestionMp()
	{
		
	}
	
	function watchKey(e)
	{
		var event = e || window.event;
		if (event.keyCode == 13)
		{
			// this cannot apply to mp questions
			answerQuestionOpen();
			return false;
		} else {
			return true;
		}
	}
	
	function setMpAnswer(o)
	{
		document.getElementById('answer').value = o.innerHTML;
		answerQuestionOpen();
	}