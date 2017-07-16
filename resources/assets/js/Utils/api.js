const url = "http://127.0.0.1:8000";

function getAuthUser() {
  return axios.get(`${url}/api/user`);
}

function getCoursesList() {
  return axios.get(`${url}/api/user/courses`);
}

function handleError(e) {
  console.warn(e);
  return null;
}

module.exports = {
  getUserCourseDetails() {
    return axios.all([
      getAuthUser(),
      getCoursesList()
    ]).then(function(response) {
      return {
        userInfo: response[0].data,
        courseInfo: response[1].data
      }
    }).catch(handleError);
  }
}
