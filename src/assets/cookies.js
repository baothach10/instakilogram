setCookie = (cName, cValue, expireDays) => {
  let date = new Date();
  date.setTime(date.getTime() + expireDays * 24 * 60 * 1000);
  const expiration = "expires=" + date.toUTCString();
  document.cookie = cName + "=" + cValue + ";" + expiration + "; path=/";
};

getCookie = (cName) => {
  const name = cName + "=";
  const cDecoded = decodeURIComponent(document.cookie);
  const cArr = cDecoded.split("; ");
  let value;
  cArr.forEach((val) => {
    if (val.indexOf(name) === 0) value = val.substring(name.length);
  });

  return value;
};

document.querySelector("#cookies-btn").addEventListener("click", () => {
  document.querySelector("#cookies").style.display = "none";
  setCookie("Cookie Accepted", true, 365);
});

cookieMessage = () => {
  if (!getCookie("Cookie Accepted"))
    document.querySelector("#cookies").style.display = "block";
};
window.addEventListener("load", cookieMessage);
