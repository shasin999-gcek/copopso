var url = location.protocol + '//' + location.host;

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
  },

  getUserCourseMap(id) {
    return axios.get(`${url}/api/user/courses/${id}`)
      .then(response => {
        return {
          status: response.status,
          data: response.data
        }
      }).catch(handleError);
  },

  getCoPoPsoMap(id) {
    return axios.get(`${url}/api/user/courses/${id}/copopso-map`)
      .catch(handleError);
  },

  getCoPoMap(id, poId) {
    return axios.get(`${url}/api/user/courses/${id}/copo-map/${poId}`)
      .catch(handleError);
  },

  fetchProgramOutcomes() {
    return axios.get(`${url}/api/user/pos`)
      .catch(handleError);
  },

  getResult(academicYear, semester) {
    return axios.get(`${url}/api/admin/results/?
        academic_year=${academicYear}&&semester=${semester}`)
      .catch(handleError);
  }
}
