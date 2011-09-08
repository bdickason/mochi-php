cfg = require '../config/config'    # contains API keys, etc.
 
# Initialize Appointment Model
Appointment = require '../models/appointment-model'

exports.Appointments = class Appointments

  get: (uid, query, callback) ->
    # Always check cache first - this should eventually go in each controller
    redisKey = "/appointments/#{uid}#{JSON.stringify query}"
    redis.get redisKey, (err, data) ->
      if data
        callback eval data
      else
        # Cache is clean, go grab it from mongo
        if uid
          # Find a single Appointment
          Appointment.findOne { uid: uid }, (err, data) ->
            if err
              console.log err
            else
              redis.set redisKey, JSON.stringify data
              callback data
        else
          # Show all appointments
          options = {} 
          options.limit = 20                 
          
          if query.page
            options.skip = options.limit * query.page        

          Appointment.find {}, [], options, (err, data) =>
            if err
              console.log err
            else
              redis.set redisKey, JSON.stringify data
              callback data
  
  set: (json, callback) ->
    # Add an appointment given some json
    # Callback should be error or no callback if successful
    appointment = new Appointment json
    
    # Check to make sure it doesn't exist
    Appointment.findOne {uid: appointment.uid}, (err, data) ->
      if data.length is 0
        # Does not exist, save it!
        appointment.save (err) ->
          if err
            console.log err
    
  update: (id) ->
    
  remove: (id) ->