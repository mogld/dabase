function joinform_check() {
    var MemberID = document.getElementById('memberID');
    var Password = document.getElementById('password');
    var PasswordCheck = document.getElementById('password_check');
    var Name = document.getElementById('name');
    var Email = document.getElementById('email');

    if(MemberID.value === "") {
        alert("아이디를 입력해주세요");
        return false;
    }

    if(Password.value === "") {
        alert("비밀번호를 입력해주세요");
        return false;
    }

    var passwordPattern = /^.{8,}$/;

    if(!passwordPattern.test(Password.value)) {
        alert("비밀번호는 8자리 이상이여야합니다.");
        return false;
    }

    if(Password.value !== (PasswordCheck.value)) {
        alert("비밀번호가 서로 일치하지 않습니다.");
        return false;
    }

    if(Name.value === "") {
        alert("이름을 입력해주세요.");
        return false;
    }

    if(Email.value === "") {
        alert("이메일을 입력해주세요.");
        return false;
    }

    return true;
}