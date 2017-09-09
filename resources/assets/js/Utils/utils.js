var genKey = module.exports = function (id) {
  let key = (Math.random() * 20 + id)
  return key;
};
