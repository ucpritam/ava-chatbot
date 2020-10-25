import re
import sys
import random

greeting_inputs =    ("hello","hi","greetings","greeting","sup","wsup","what's up","hey","heya","hey","hi there","heloo","heelo")
greeting_responses  =   ["Hi there, How can I help you?","Hey, How may I help you?","Hi there, Hope you are doing well!","Hello, How may I help you?"] 
thank_you  =    [ "thanksx","thans","thank u", "thank you","thanx","thanks","thank","thnx","tnx","thnkx","thanx" ]
bye= ["bye","byyyy","goodbye","good bye","byi"]
bye_response= ["Bye! Good Day", "GoodBye, See You Soon","GoodDay, Happy to help you!!"]


def greeting(sentence):
        for word in sentence.split():
                if word.lower() in greeting_inputs:
                        return random.choice(greeting_responses)

def bye_function(sentence):
        for word in sentence.split(" "):
                if word.lower() in bye:
                        return random.choice(bye_response)
                        
def main_passer(item):
        check=item.lower().split() 
        if greeting(item)!=None and len(item)<30 :
                return greeting(item)
        elif item.lower() in thank_you:
                return "You're Welcome! "
        elif bye_function(item) !=None and len(item)<30:
                return bye_function(item)
        elif "donate" in check or "pledge" in check :
                return "Go to Pledge Page then Create a account at Bloom India then Fill the Donor Form after that Take the pledge to become donor by just clicking I Agree to Pledge."
        elif "update" in check:
                return "Once you open Bloom India website there is a Option to update profile click on that and Bloom India asks you for your email that you used for pledging, Once you give your e-mail the website verifies your profile through OTP and then you can update your profile."
        elif "search" in check or "find" in check:
                return "Once you open Bloom India Profile there you can find the option called SEARCH on top, you can search for required donors, by entering your location and blood group needed the the Bloom India shows you all available donors near your location then you can enter the details of donee and press on Reach Out then Bloom India sends the messages and emails to the donors near-by."
        elif "profile" in check :
                return "Bloom India profile is created through pledging,Once you pledge as a donor your profile is created automatically in the bloom website where your email acts as your identity to find your account."
        elif "eligible" in check or "eligibility" in check :
                return "To be a donor you must be, Fit and healthy and should not be suffering from transmittable diseases. The donor must be 18 to 65 years old and should weigh a minimum of 50 kg. Pulse rate must be between 50 and 100 without irregularities. Hemoglobin level a minimum of 12.5 g/dL. Blood pressure should be normal. Body temperature Should be normal, with an oral temperature not exceeding 37.5C. The time period between successive blood donations should be more than 3 months."
        elif "donor" in check:
                return "Go to Pledge Page then Create a account at Bloom India then Fill the Donor Form after that Take the pledge to become donor by just clicking I Agree to Pledge."
        elif "benefit" in check or "privilege" in check or "card" in check:
                return "Once someone pledges to be a donor, we give him a Privilege Card. This Privilege Card can be redeemed at Pharmacies, Diagnostics centers, Satvik Restaurants, online or offline stores. The Privilege card would be sent on whatsapp/SMS/EMail and would have QR code which can be scanned. Once someone uses this card, they get a discount for their purchase."
        elif "bloom" in check :
                return "Bloom India is network of generous donors, volunteers and employees share a mission of preventing and relieving suffering, here at home and around the world. Bloom India is an online platform for organ donors. This platform supports multiple organ donations, Currently this platform works for blood donors."
        else:
                return "Sorry I am not able to understand it. Ava is still learning."

item=" ".join(sys.argv[1:])
output=main_passer(item)
print(output)