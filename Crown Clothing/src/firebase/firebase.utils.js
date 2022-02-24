import firebase from 'firebase/app';
import 'firebase/firestore';
import 'firebase/auth';

const config = {
    apiKey: "AIzaSyCpIRRLM8ZqlQs1h-ZVdps1K2oAXlmfdYk",
    authDomain: "crwn-db-e274d.firebaseapp.com",
    databaseURL: "https://crwn-db-e274d.firebaseio.com",
    projectId: "crwn-db-e274d",
    storageBucket: "crwn-db-e274d.appspot.com",
    messagingSenderId: "1064327137365",
    appId: "1:1064327137365:web:9b70bfabedbb19ea936cdc",
    measurementId: "G-5TTYRM626T"
  };

firebase.initializeApp(config);

export const createUserProfileDocument = async (userAuth, additionalData) => {
  if (!userAuth) return;

  const userRef = firestore.doc(`users/${userAuth.uid}`);

  const snapShot = await userRef.get();

  if (!snapShot.exists) {
    const { displayName, email } = userAuth;
    const createdAt = new Date();
    try {
      await userRef.set({
        displayName,
        email,
        createdAt,
        ...additionalData
      });
    } catch (error) {
      console.log('error creating user', error.message);
    }
  }

  return userRef;
};

export const auth = firebase.auth();
export const firestore = firebase.firestore();

const provider = new firebase.auth.GoogleAuthProvider();
provider.setCustomParameters({ prompt: 'select_account' });
export const signInWithGoogle = () => auth.signInWithPopup(provider);

export default firebase;
