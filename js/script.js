
	$.get("./inc/getBlog2.php", function(data){
			
			var blog = JSON.parse(data);
			blogBits(blog);	
				
		});
	
	
	function blogBits(data){
			x=0;
			
			console.log(data.channel);
			while (x<=3){
				
				// ** TITLE ** //
				
				// Grabs title from JSON array //
				// Wraps the title in <span class=”title"> //
				var title = data.channel.item[x].title;
				var postTitle = $("<span/>").addClass("title").append(title);

				// ** DATE ** //
				
				// Grabs date from JSON array //
				// Converts returned dateString into mm-dd-yyyy using dateConverter function //
				// Wraps the date in <span class=”date"> //				
				var date = dateConverter(data.channel.item[x].pubDate);
				var	postDate = $("<span/>").addClass("date").append(date);


				// ** LINK ** //
				
				// Grabs link from JSON array // 
				var postLink = data.channel.item[x].guid;

				// ** HTML ** //
				// makes a <li> to be entered in to <ul> //
				// formatted <li class=”post”>
				var makeli = $("<li></li>").addClass("post");					
				var br = "<br/>";
				
				// ** Make LINK ** //
				// Appends link data //
				// Appends html //
				var makeahref = $("<a></a>").attr({"href":postLink,"target":"_blank"})
											.append(postTitle,br,postDate)
											.appendTo(makeli);	
				$(makeli).appendTo("ul.IFGBlog");													
				x++;
			}		
	}

	function dateConverter(date){
			datePieces = date.split(" ");
			
			month = datePieces[2];
			day = datePieces[1];
			year = datePieces[3]
			
			return pubDate = month+ "-"+day+ "-"+year;
			
			
	}	
	




