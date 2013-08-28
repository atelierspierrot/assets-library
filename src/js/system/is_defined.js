/**
 * <b>Is defined ?</b>
 * Returns TRUE if 'str' is already defined 
 * (and optionnaly TRUE if it's defined as the 'type' you want)
 *
 * @param ? str The string you want to verify (can be a string or anything else)
 * @param string type The type you want verify 'str' is | optional
 */
function is_defined(str, type){
	try {
		str = (str.charAt(str.length-1) == ')') ? str.substring(0, str.length-2) : str;
	} catch(e) { }
	try {
		var tested = self.eval(str);
		if(tested != undefined && typeof(tested) != undefined){
			if(!type) return true;
			else {
				if(typeof(tested) == type) return true;
				else return false;
			}
		}
	} catch(e) {
		return false;
	}
	return false;
}
