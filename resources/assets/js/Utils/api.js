function getAuthUser() {
  return axios.get('/users/api/getUserData');
}

function getCoursesList() {
  return axios.get('/users/api/getUserCourseData');
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
