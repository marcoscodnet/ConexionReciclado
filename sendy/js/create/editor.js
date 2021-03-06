$(document).ready(
	function()
	{
		$('#html').redactor({
			autoresize: true,
			imageUpload: 'includes/create/upload.php',
			convertDivs: false,
			convertLinks: false,
			observeLinks: true,			
			overlay: false,
			minHeight: 600,
			cleanup: false,
			iframe: true,
			fullpage: true,
			//Fix toolbar
			fixed: true, 
			toolbarFixedBox: true, 
			toolbarFixedTopOffset: 45,
			//Toolbar buttons
			plugins: ['fontcolor', 'fontsize', 'fontfamily', 'personalizationtags'],
			buttons: ['html', 'bold', 'italic', 'deleted', 'formatting', 'link', 'image', 'table', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'alignment', 'horizontalrule'],
		    buttonsCustom: {
	            tags: {
	                title: "Insert tags",
	                dropdown: {
	                    point1: {
	                        title: 'Insert unsubscribe tag',
	                        callback: function(obj, event, key){$('#html').insertHtml('<unsubscribe>Unsubscribe here</unsubscribe>');}
	                    },
	                    point2: {
	                        title: 'Insert webversion tag',
	                        callback: function(obj, event, key){$('#html').insertHtml('<webversion>View web version</webversion>');}
	                    },
	                    point3: {
	                        title: 'Insert name tag',
	                        callback: function(obj, event, key){$('#html').insertHtml('[Name,fallback=]');}
	                    },
	                    point4: {
	                        title: 'Insert email tag',
	                        callback: function(obj, event, key){$('#html').insertHtml('[Email]');}
	                    }
	                }
	            }
	        }
		});
	}
);