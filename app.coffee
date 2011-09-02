http = require 'http'
url = require 'url'
express = require 'express'
Redis = require 'redis'
RedisStore = (require 'connect-redis')(express)
sys = require 'sys'
cfg = require './config/config.js'    # contains API keys, etc.
winston = require 'winston'

# Setup logging
global.logger = new (winston.Logger)( {
  transports: [
    new (winston.transports.Console)({ level: 'debug', colorize: true }), # Should catch 'debug' levels (ideally error too but oh well)
    ]
})

 
# Setup Server
app = express.createServer()
io = (require 'socket.io').listen app

# Start up redis to cache stuff
redis = Redis.createClient cfg.REDIS_PORT, cfg.REDIS_HOSTNAME
redis.on 'error', (err) ->
  console.log 'REDIS Error:' + err

app.configure ->
  app.set 'views', __dirname + '/views'
  app.set 'view engine', 'jade'
  app.register '.html', require 'jade'
  app.use express.methodOverride()
  app.use express.bodyParser()
  app.use express.cookieParser()
  app.use express.session { secret: cfg.SESSION_SECRET, store: new RedisStore, key: cfg.SESSION_ID }
  app.use app.router
  app.use express.static __dirname + '/public'  

app.dynamicHelpers { session: (req, res) -> req.session }

# Initialize DB
global.db = require('./models/db').db

### Initialize controllers ###
Users = (require './controllers/users').Users
Import = (require './controllers/utils/import').Import   # Temporary importer script from mysql

# Home Page
app.get '/', (req, res) ->
  console.log 'blah'

app.get '/users', (req, res) ->
  users = new Users
  imp = new Import
  
  imp.users (json) =>
    for user in json.users
      # Takes a single user (json), cleans it up, shoves it into mongo

      # HACK - for some reason doing a 'for key in user' doesn't work so this will have to do for now
      # Clean up the data a bit
      
      # Phone numbers -> array/json
      user.phone = []
      if user.phone_primary_type is 'pager'
        console.log 'seriously?!'
      if user.phone_primary_number isnt null and user.phone_primary_number isnt ''
        user.phone.push {number: user.phone_primary_number, type: user.phone_primary_type}      
      delete user.phone_primary_number
      delete user.phone_primary_type

      if user.phone_secondary_number isnt null and user.phone_secondary_number isnt ''
        user.phone.push {number: user.phone_secondary_number, type: user.phone_secondary_type}      
      delete user.phone_secondary_number
      delete user.phone_secondary_type
      
      # Address -> array/json
      user.address = {}
      if user.address_street isnt null and user.address_street isnt ''
        user.address.street = user.address_street
      if user.address_apartment isnt null and user.address_apartment isnt ''
        user.address.apartment = user.address_apartment
      if user.address_city isnt null and user.address_city isnt ''
        user.address.city = user.address_city
      if user.address_state isnt null and user.address_state isnt ''
        user.address.state = user.address_state
      if user.address_zip isnt null and user.address_zip isnt ''
        user.address.zip = user.address_zip
      delete user.address_street
      delete user.address_apartment
      delete user.address_city
      delete user.address_state
      delete user.address_zip
      
      if user.email is null or user.email is ''
        delete user.email
      if user.uid is null or user.uid is ''
        delete user.uid
      if user.last_transaction_date is null or user.last_transaction_date is ''
        delete user.last_transaction_date
      if user.ssn is null or user.ssn is ''
        delete user.ssn
      if user.permissions is null or user.permissions is ''
        delete user.permissions            
        
      users.set user, (callback) ->

  
  # users.get (json) ->
  #     res.send json

  

### Socket.io Stuff ###
# Note, may need authentication later: https://github.com/dvv/socket.io/commit/ff1bcf0fb2721324a20f9d7516ff32fbe893a693#L0R111

io.enable 'browser client minification'
io.set 'log level', 2

app.listen process.env.PORT or 3000 