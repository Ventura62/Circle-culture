interface Friend {
  name: string;
  location: string;
  isFavorite?: boolean;
}

interface FriendsCardProps {
  friends: Friend[];
}

const FriendCard = ({ friends }: FriendsCardProps) => {
  return (
    <div className="grid grid-cols-1 gap-4 w-full justify-center">
      {friends.map((friend, index) => (
        <div
          key={index}
          className="bg-background text-white p-4 rounded-lg border border-gray-600 flex items-center"
        >
          <div className="w-12 h-12 !bg-gray-400  rounded-full flex-shrink-0 relative">
            {friend.isFavorite && (
              <div className="absolute -top-1 -right-1 bg-white  rounded-full px-1">
                <span className="text-yellow-400 text-lg">🫶</span>
              </div>
            )}
          </div>

          <div className="ml-4">
            <p className="text-lg font-semibold">{friend.name}</p>
            <p className="text-sm text-gray-400">📍 {friend.location}</p>
          </div>
        </div>
      ))}
    </div>
  );
};

export default FriendCard;
