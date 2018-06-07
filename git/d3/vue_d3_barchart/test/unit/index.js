// require all .spec files
var testsContext = require.context('./specs/', true, /\.spec$/)
testsContext.keys().forEach(testsContext)
