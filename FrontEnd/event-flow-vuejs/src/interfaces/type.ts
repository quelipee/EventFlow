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
  eventEnd: string | Date,
  eventStart: string | Date,
  id: number,
  user_id: number,
  status: string
}
