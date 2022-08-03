var POST = function (api, data, func ){
	//  주소와 데이터를, xml로 전송하는 함수
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){ 
		// 상태가 변화면 function 을 실행하는데
		if(request.readyState == 4){
			try {
				var resp = JSON.parse(request.response)
			} catch (e){
				var resp = {status: 'error', data: request.responseText};
				alert(request.responseText);
			}
			func(resp);
			//  request.response 에서 가져온 값을 외부지정 func를 통해 처리
		}
	};
	request.open("POST", api);
	//  XML을통해 post방식으로 새로운걸 주소로 전송
	request.send(data);
	return request;
}