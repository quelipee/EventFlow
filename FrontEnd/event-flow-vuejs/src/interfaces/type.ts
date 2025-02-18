export interface User {
    name? : string,
    email : string,
    password : string,
    passwordRepeat? : string
}

export interface EventStore {
  title: string,
  created_at: Date,
  updated_at: Date,
  description: string,
  eventEnd: Date,
  eventStart: Date,
  id: number,
  user_id: number
}
