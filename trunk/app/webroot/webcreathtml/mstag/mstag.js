(function() {
	if (!window.mstag || typeof(mstag.loadTag) != 'function') return;
	var a = mstag,
		b = document.getElementById('mstag_tops');
	if (!mstag._write) mstag._write = function(s) {
		document.write(s);
	};
	
	a.version = '1003102000';
	a.site = {
		siteId: '76492f22-0c84-41ac-a8fe-21390e2bb0f3',
		version: '1405281400'
	};
	
	a.site.properties = {};
	
	if (b && b.src) {
		var c = b.src.split('//')[1].split('/');
		a.prefix = '//' + c[0] + '/' + c[1];
	}
	if (a.prefix) a._write("<script type='text/javascript' src='" + a.prefix + "/mstag." + a.version + ".js'></scr" + "ipt>");
})();